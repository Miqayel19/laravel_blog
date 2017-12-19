var app = angular.module('app.controller',['ngRoute']);
    app.controller('AuthController',function($scope,$http,$location){
        $scope.isLogin = function(){
            $scope.logged_user = localStorage.getItem('log_user');
            if(localStorage.getItem('log') == 1){
                return true
            }
            return false
        },
        $scope.isNotLogin = function(){
            $scope.logged_user = localStorage.getItem('log_user');
            if(localStorage.getItem('log') == 0){
                return true
            }
            return false
        },
        $scope.login = function(){
            var data = {
                email: $scope.mail,
                password: $scope.password,
            }
            $http.post('/api/login',data).then(function(response){
                localStorage.setItem('log_user', response.data.resource.name);
                localStorage.setItem('log',1);
                $location.path('/home');
            }).catch((error)=> {
                    console.log(error);
            });
        },    
        $scope.logout = function(){
            localStorage.clear();
            localStorage.setItem('log',0);
            $http.get('/api/logout').then((response) => {          
                $location.path('/'); 
            }).catch((error) => {
                console.log(error);
            });
        };
    });    
    app.controller('RegisterController',function($scope,$http, $location){
        $scope.register = function(){
            var data = {
                name: $scope.name,
                email: $scope.mail,
                password: $scope.password,
                password_confirmation: $scope.password_confirm
            }
            $http.post('/api/register',data).then(function(response){
                localStorage.setItem('logged_user', response.data.resource.name);
                $location.path('/home');
            }).catch((error)=> {
                console.log(error);
            });
        };
    });
    app.controller('HomeController',function($scope,$http){
        $http.get('/api/categories').then((response) => {          
            $scope.categories = response.data.resource;
        }).catch((error)=> {
            console.log(error);           
        })  
        $http.get('/api/posts').then((response) => {          
            $scope.posts = response.data.resource;
        }).catch((error)=> {
            console.log(error);           
        });
    }); 
    app.controller('CategoriesController',function($scope,$http,$location,$routeParams){
            $http.get('/api/me/categories').then((response) => {
                $scope.myCategories = response.data.resource;
            }).catch((error) => {console.log(error);})            
        $scope.addCategory = function(){
            $http.post('/api/me/categories',{title:$scope.name}).then((response) => {
                $scope.myCategories = response.data.resource;
                $location.path('/me/categories');
            }).catch((error)=> {
                console.log(error);
            }); 
        },
        $scope.deleteCategory = function($id){
            $http.delete('/api/me/categories/'+$id,{title:$scope.name}).then((response) => {
                $scope.myCategories = response.data.resource;
                $location.path('/me/categories')
            }).catch((error)=> {
                console.log(error);
            }); 
        },
        $scope.updateCategory = function(){
            var id = $routeParams.id;
            $http.put('/api/me/categories/'+id,{title:$scope.name}).then((response) => {
                $location.path('/me/categories'); 
            }).catch((error)=>{
                console.log(error);
            });
        }
    });
    app.controller('PostsController',function($scope,$http,$location,$routeParams){
            $http.get('/api/me/posts').then((response) => {
                $scope.myPosts = response.data.resource;
            }).catch((error) => {console.log(error);})
            $http.get('/api/me/categories').then((response) => {
                $scope.myCategories = response.data.resource;
            }).catch((error) => {
                console.log(error);
            }) 
        $scope.addPost = function(){
            var info = new FormData();
            info.append('text',$scope.text);
            info.append('title',$scope.title);
            info.append('image',$scope.myFile);
            info.append('cat_id',$scope.mycategory.id);
            $http.post('/api/me/posts',info,{
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            })
            .then((response) =>{
                $scope.myPosts = response.data.resource;
                $location.path('/me/posts'); 
            })
            .catch((error)=>{
                console.log(error);
            });
        },
        $scope.deletePost = function($id){
            $http.delete('/api/me/posts/'+$id,{title:$scope.name}).then((response) => {
                $scope.myPosts = response.data.resource;
                $location.path('/me/posts'); 
            }).catch((error)=> {
                console.log(error);
            });
        },
        $scope.updatePost = function(){
            var id = $routeParams.id;
            var info = new FormData()
            info.append('text',$scope.text);
            info.append('title',$scope.title);
            info.append('image',$scope.myFile);
            info.append('id',$routeParams.id);
            info.append('_method','PUT');
            $http.post('/api/me/posts/'+id,info,{
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            }).then((response) => {
                $scope.myPosts = response.data.resource;
                $location.path('/me/posts'); 
                }).catch((error)=> {
                console.log(error);
            }); 
        }
    })
