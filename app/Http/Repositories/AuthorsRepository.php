<?php
    namespace App\Http\Repositories;

    use App\Author;
    use Illuminate\Filesystem\Filesystem;
    use Illuminate\Log\Writer as Log;
    use Illuminate\Session\Store as Session;

    //use Illuminate\Pagination\LengthAwarePaginator as Paginator;

    /**
     * Class AuthorRepository
     *
     * @package App\Http\Repositories
     */
    class AuthorsRepository extends BaseRepository
    {

        /**
         * The author model implementation.
         *
         * @var Author
         */
        protected $author;

        /**
         * Create a author repository instance.
         *
         * @param Author  $author
         * @param Log      $log
         * @param Session  $session
         * @param Auth     $auth
         * @param Password $password
         */
        function __construct( Author $author, Log $log, Session $session, Filesystem $filesystem )
        {
            parent::__construct( $log, $session );

            $this->author = $author;

            $this->filesystem = $filesystem;
        }

        /**
         * Search authors by firstname, lastname or email
         *
         * @param $search
         *
         * @return $this
         */
        public function search( $search )
        {
            $this->author = $this->author->where( "name", "like", "%".$search."%" );

            return $this;
        }

        protected function _all()
        {
            return $this->author->with('projects')->orderBy( "name", "ASC" );
        }

        /**
         * @return Collection
         */
        public function all()
        {

            return $this->_all()->get();
        }

        /**
         * @param int $perPage
         *
         * @return Collection
         */
        public function paginate( $perPage = 50 )
        {
            $all = $this->_all()->paginate( $perPage );

            //            $paginator = new Paginator( $all, $perPage, Paginator::resolveCurrentPage(), [ "path" => Paginator::resolveCurrentPath() ] );

            return $all;
        }

        public function optionArray()
        {

            $authors = $this->all();

            $result = [ ];

            foreach ( $authors as $v )
            {
                $result[ $v->id ] = $v->name;
            }

            return $result;
        }


        protected function _createOrUpdate( Author $author, array $author_data )
        {

            $author_data = $this->_addSlug( $author_data );

            if ( $this->filesystem->isFile( $author->image ) )
            {
                $this->filesystem->delete( $author->image );
            }


            $author->fill( $author_data );
            $author->save();

            if ( isset( $author_data[ "image" ] ) )
            {
                $this->_uploadImage( $author, $author_data[ "image" ] );
            }

            $author_data[ 'categories' ] = ( isset( $author_data[ 'categories' ] ) ) ? $author_data[ 'categories' ] : [ ];
            $author->categories()->sync( $author_data[ 'categories' ] );

            $author->save();


        }

        protected function _uploadImage( Author $author, $file )
        {
            $path = public_path()."/uploads/authors/".$author->id."/";
            $filename = str_random( 12 ) .'.' .$file->guessClientExtension();

            if ( !$this->filesystem->isDirectory( $path ) )
            {
                $this->filesystem->makeDirectory( $path, 0755, true );
            }

            $file->move($path, $filename);

            $author->image =  "/uploads/authors/".$author->id."/".$filename;
            $author->save();
        }

        /**
         * @param $author
         *
         * @return null|Author
         */
        public function create( $author_data )
        {
            if ( isset( $author_data[ "id" ] ) )
            {
                return null;
            }

            $author = new Author;

            $this->_createOrUpdate( $author, $author_data );

            $this->log->info( "Author created:\n\n ".var_export( $author->with( 'categories' )->first()->toArray(), true ) );

            return $author;
        }


        /**
         * @param $data
         *
         * @return Author
         */
        public function update( $author_data )
        {
            $author = Author::find( $author_data[ "id" ] );

            $this->_createOrUpdate( $author, $author_data );

            $this->log->info( "Author updated:\n\n ".var_export( $author->with( 'categories' )->first()->toArray(), true ) );

            return $author;


        }

        /**
         * @param $data
         *
         * @return bool
         */
        public function destroy( $author )
        {
            $path = public_path().'/uploads/authors/'.$author->id;

            if (  $this->filesystem->deleteDirectory($path) and $this->author->destroy( $author->id ))
            {
                $this->log->info( "Author deleted:\n\n ".var_export( $author->toArray(), true ) );

                return true;
            }

            return false;
        }

        private function _addSlug( array $author )
        {


            $slug      = $this->_slugify( $author[ "name" ] );
            $test_slug = ( isset( $author[ "slug" ] ) and !empty( $author[ "slug" ] ) ) ? $author[ "slug" ] : $slug;

            $i = 0;
            while ( $this->slugExist( $author, $test_slug ) )
            {
                $test_slug = $slug."-".++$i;
            }

            $author[ "slug" ] = $test_slug;

            return $author;
        }

        /**
         * @param $test_slug
         *
         * @return mixed
         */
        private function slugExist( $author, $test_slug )
        {
            $test_author = $this->author->whereSlug( $test_slug );
            if( isset($author["id"]) ) $test_author = $test_author->where("id", "!=", $author["id"]);
            return $test_author->first();
        }
    }