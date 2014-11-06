<?php
    namespace App\Http\Repositories;

    use App\Project;
    use App\Category;
    use Illuminate\Filesystem\Filesystem;
    use Illuminate\Log\Writer as Log;
    use Illuminate\Session\Store as Session;

    //use Illuminate\Pagination\LengthAwarePaginator as Paginator;

    /**
     * Class ProjectRepository
     *
     * @package App\Http\Repositories
     */
    class ProjectsRepository extends BaseRepository
    {

        /**
         * The project model implementation.
         *
         * @var Project
         */
        protected $project;

        /**
         * Create a project repository instance.
         *
         * @param Project  $project
         * @param Log      $log
         * @param Session  $session
         * @param Auth     $auth
         * @param Password $password
         */
        function __construct( Project $project, Log $log, Session $session, Filesystem $filesystem )
        {
            parent::__construct( $log, $session );

            $this->project = $project;

            $this->filesystem = $filesystem;
        }

        /**
         * Search projects by firstname, lastname or email
         *
         * @param $search
         *
         * @return $this
         */
        public function search( $search )
        {
            $this->project = $this->project->where( "name", "like", "%".$search."%" )->orWhereHas('authors', function ($q) use ($search) {
                $q->where('name', 'like', "%".$search."%");
            })->orWhereHas('categories', function ($q) use ($search) {
                $q->where('name', 'like', "%".$search."%");
            });

            return $this;
        }

        protected function _all()
        {
            return $this->project->with( 'categories' )->orderBy( "name", "ASC" );
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

        public function category( Category $category )
        {
            $this->project = $this->project->whereHas('categories', function ($q) use ($category) {
                $q->whereId($category->id);
            });

            return $this;
        }

        public function optionArray()
        {

            $projects = $this->all();

            $result = [ ];

            foreach ( $projects as $v )
            {
                $result[ $v->id ] = $v->name;
            }

            return $result;
        }


        protected function _createOrUpdate( Project $project, array $project_data )
        {

            $project_data = $this->_addSlug( $project_data );

            if ( $this->filesystem->isFile( $project->image ) )
            {
                $this->filesystem->delete( $project->image );
            }


            $project->fill( $project_data );
            $project->save();

            if ( isset( $project_data[ "image" ] ) )
            {
                $this->_uploadImage( $project, $project_data[ "image" ] );
            }

            $project_data[ 'categories' ] = ( isset( $project_data[ 'categories' ] ) ) ? $project_data[ 'categories' ] : [ ];
            $project->categories()->sync( $project_data[ 'categories' ] );

            $project->save();


        }

        protected function _uploadImage( Project $project, $file )
        {
            $path = public_path()."/uploads/projects/".$project->id."/";
            $filename = str_random( 12 ) .'.' .$file->guessClientExtension();

            if ( !$this->filesystem->isDirectory( $path ) )
            {
                $this->filesystem->makeDirectory( $path, 0755, true );
            }

            $file->move($path, $filename);

            $project->image =  "/uploads/projects/".$project->id."/".$filename;
            $project->save();
        }

        /**
         * @param $project
         *
         * @return null|Project
         */
        public function create( $project_data )
        {
            if ( isset( $project_data[ "id" ] ) )
            {
                return null;
            }

            $project = new Project;

            $this->_createOrUpdate( $project, $project_data );

            $this->log->info( "Project created:\n\n ".var_export( $project->with( 'categories' )->with( 'authors' )->first()->toArray(), true ) );

            return $project;
        }


        /**
         * @param $data
         *
         * @return Project
         */
        public function update( $project_data )
        {
            $project = Project::find( $project_data[ "id" ] );

            $this->_createOrUpdate( $project, $project_data );

            $this->log->info( "Project updated:\n\n ".var_export( $project->with( 'categories' )->with( 'authors' )->first()->toArray(), true ) );

            return $project;


        }

        /**
         * @param $data
         *
         * @return bool
         */
        public function destroy( $project )
        {
//            $path = public_path().'/uploads/projects/'.$project->id;
//            $this->filesystem->deleteDirectory($path)

            if ( $this->project->destroy( $project->id ))
            {
                $this->log->info( "Project deleted:\n\n ".var_export( $project->toArray(), true ) );

                return true;
            }

            return false;
        }

        private function _addSlug( array $project )
        {



            $slug      = $this->_slugify( $project[ "name" ] );
            $test_slug = ( isset( $project[ "slug" ] ) and !empty( $project[ "slug" ] ) ) ? $project[ "slug" ] : $slug;

            $i = 0;
            while ( $this->slugExist( $project, $test_slug ) )
            {
                $test_slug = $slug."-".++$i;
            }

            $project[ "slug" ] = $test_slug;

            return $project;
        }

        /**
         * @param $test_slug
         *
         * @return mixed
         */
        private function slugExist( $project, $test_slug )
        {
            $test_project = $this->project->whereSlug( $test_slug );

            if( isset($project["id"]) ) $test_project = $test_project->where("id", "!=", $project["id"]);
            return $test_project->first();
        }
    }