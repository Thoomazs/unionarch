<?php
    namespace App\Http\Repositories;

    use App\Log;
    use \Illuminate\Auth\Guard as Auth;
    //use Illuminate\Pagination\LengthAwarePaginator as Paginator;
//    use Illuminate\Pagination\Paginator as Paginator;

    class LogRepository
    {

        protected $log;
        protected $auth;


        function __construct( Log $log, Auth $auth )
        {
            $this->log = $log;
            $this->auth = $auth;
        }

        /**
         * @param $search
         *
         * @return $this
         */
        public function search( $search )
        {
            $this->log = $this->log->where( "message", "like", "%".$search."%" )->orWhere( "created_at", "like", "%".$search."%" );

            return $this;
        }

        protected  function _all()
        {
            return $this->log->with( "user" )->orderBy( "id", "DESC" );
        }

        /**
         * @return mixed
         */
        public function all()
        {

            return $this->_all()->get();
        }

        /**
         * @param int $perPage
         *
         * @return \Illuminate\Pagination\LengthAwarePaginator
         */
        public function paginate( $perPage = 100 )
        {
            $all = $this->_all()->paginate( $perPage );

//            $paginator = new Paginator( $all, $perPage, Paginator::resolveCurrentPage(), [ "path" => Paginator::resolveCurrentPath() ] );

            return $all;
        }
    }