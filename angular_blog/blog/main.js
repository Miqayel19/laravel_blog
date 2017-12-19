 var app = angular.module('App',["ngRoute","app.controller"]);
    app.directive('fileModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                var model = $parse(attrs.fileModel);
                var modelSetter = model.assign;
                element.bind('change', function(){
                    scope.$apply(function(){
                        modelSetter(scope, element[0].files[0]);
                    });
                });
            }
        };
    }]);
    app.config(function($routeProvider) {
        $routeProvider
        .when("/login", {
            templateUrl: 'auth/Login.html',
            controller: 'AuthController'
        })
        .when("/register", {
            templateUrl: 'auth/Register.html',
            controller: 'RegisterController'
        })
        .when("/home", {
            templateUrl: 'home/Home.html',
            controller: 'HomeController'
        })
        .when("/me/categories", {
            templateUrl: 'categories/MyCategories.html',
            controller: 'CategoriesController'
        })
        .when("/me/categories/add", {
            templateUrl: 'categories/AddCategory.html',
            controller: 'CategoriesController'
        })
        .when("/me/categories/:id", {
            templateUrl: 'categories/EditCategory.html',
            controller: 'CategoriesController'
        })
        .when("/me/posts", {
            templateUrl: 'posts/MyPosts.html',
            controller: 'PostsController'
        })  
        .when("/me/posts/add", {
            templateUrl: 'posts/AddPost.html',
            controller: 'PostsController'
        })
        .when("/me/posts/:id", {
            templateUrl: 'posts/EditPost.html',
            controller: 'PostsController'
        });
    });
