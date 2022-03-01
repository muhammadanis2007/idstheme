// JavaScript Document
// initialize the app



console.log("ANIS");
var idsapps = angular.module('idsapps', ['ngRoute', 'ngSanitize', 'ngAnimate']);
console.log("APP : " + idsapps);
idsapps.config(['$routeProvider', '$locationProvider',
    function($routeProvider, $locationProvider) {


        $routeProvider
            .when('/main', {
                templateUrl: document.getElementById('themepath').value + '/main.html',
                
                controller: 'mainController',
                controllerAs: 'main'
            })
            .when('/:slug/', {
                templateUrl: document.getElementById('themepath').value + '/content/content.html',
                
                controller: 'ContentCtrl',
                controllerAs: 'content',
                animate: 'ng-animate'
            })
            .when('/topics/:slug/', {
                templateUrl: document.getElementById('themepath').value + '/topics/post.html',
               
                controller: 'topicCtrl',
                controllerAs: 'topics' //Define new view file html ng-view
            })
            .otherwise({ redirectTo: '/main' });

        $locationProvider.html5Mode(true);

    }
])





idsapps.controller('mainController', function($scope, $http) {

    $http({
        method: "GET",
        url: "/api/get_posts/"
    }).then(function mySucces(response) {
           


            var allposts = response.data.posts;
            $scope.allposts = response.data.posts;

           

            $scope.setFilter = function(post, event) {
             	
		var oEvent = event||window.event;             
                var self = oEvent.target||oEvent.srcElement;
		
		var btns = angular.element('button');
                btns.removeClass('active');
		
		$scope.design = post;
               	 angular.element(self).addClass('active');
		
               	console.log("Check active classess : " + post);
		


            }


        },
        function myError(response) {
            $scope.myWelcome = response.statusText;
        });
});




idsapps.controller('ContentCtrl', ['$scope', '$http', '$routeParams', '$sce', function($scope, $http, $routeParams, $sce) {

    $http({
        method: "GET",
        url: "/api/get_page/?slug=" + $routeParams.slug
    }).then(function mySucces(response) {
		
		
          
            var page = response.data.page;

            $scope.page = response.data.page;

		/*
		console.log("TEST slug active : "+$scope.page.slug + $routeParams.slug);
		
		var btnVal = $scope.page.slug;
		var pageSlug = $routeParams.slug;
		if(pageSlug.toString() == btnVal.toString())
		{ 
		console.log("CLICK EVENT : " + pageSlug.toString() == btnVal.toString());
		angular.element('nav ul li a').removeClass('active');
		$(this).addClass('active');	
		}
		*/
			

		
		
            $scope.htmlSafe = function(data) {
              
                return $sce.trustAsHtml(data);
            }

        },

        function myError(response) {
            $scope.myWelcome = response.statusText;
        });





}]);


idsapps.controller('topicCtrl', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams) {

    $http({
        method: "GET",
        url: "/api/get_post/?slug=" + $routeParams.slug
    }).then(function mySucces(response) {

            console.log("post : " + response.data.post.title + " TYPE : " + response.data.post.thumbnail_images.full.url);
            var page = response.data.post;
            $scope.page = response.data.post;
            $scope.page.images = response.data.post.thumbnail_images.full.url
         

        },

        function myError(response) {
            $scope.myWelcome = response.statusText;
        });





}]);






$(document).ready(function(e) {

    //    setTimeout(function() { $(".cates:empty").remove(); }, 2000)
    console.log("JQ");
});