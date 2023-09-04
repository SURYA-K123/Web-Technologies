var app = angular.module('carouselApp', ['ngRoute']);
app.controller('CarouselController', function ($scope, $interval) {
    $scope.carouselItems = [
        { imageUrl: 'co.png ', caption: 'Image 1' },
        { imageUrl: 'oc.png', caption: 'Image 2' },
        { imageUrl: 'ca.png', caption: 'Image 3' }
    ];

    $scope.currentIndex = 0;
    $scope.isAutoPlay = true;

    var autoPlayInterval;

    $scope.next = function () {
        $scope.currentIndex = ($scope.currentIndex + 1) % $scope.carouselItems.length;
    };

    $scope.prev = function () {
        $scope.currentIndex = ($scope.currentIndex - 1 + $scope.carouselItems.length) % $scope.carouselItems.length;
    };

    $scope.toggleAuto = function () {
        $scope.isAutoPlay = !$scope.isAutoPlay;
        if ($scope.isAutoPlay) {
            startAutoPlay();
        } else {
            stopAutoPlay();
        }
    };

    function startAutoPlay() {
        autoPlayInterval = $interval(function () {
            if ($scope.isAutoPlay) {
                $scope.next();
            }
        }, 3000);
    }

    function stopAutoPlay() {
        if (angular.isDefined(autoPlayInterval)) {
            $interval.cancel(autoPlayInterval);
        }
    }

    startAutoPlay();
});

app.controller('myCtrl1', function ($scope) {
    $scope.reviews = [
        { userName: 'Anand', rating: 5, comment: 'Quality Service Provided' },
        { userName: 'Subu', rating: 4, comment: 'Got a good knowledge of B.Tech Admissions.' },
        { userName: 'Surya', rating: 3, comment: 'Really Easy to know abt MBBS admission Procedure' }
    ];
    $scope.ratings = [5, 4, 3, 2, 1];
    $scope.selectedRating = '';
    $scope.newReview = {
        userName: '',
        rating: '',
        comment: ''
    };
    $scope.addReview = function () {
        $scope.reviews.push(angular.copy($scope.newReview));
        $scope.newReview.userName = '';
        $scope.newReview.rating = '';
        $scope.newReview.comment = '';
    };
});

app.controller('ShoppingListAddController', ShoppingListAddController);
app.controller('ShoppingListShowController', ShoppingListShowController);
app.service('ShoppingListService', ShoppingListService);
app.factory('ShoppingListFactory', ShoppingListFactory);
function ShoppingListService() {
    var service = this;
    var items = [];
    service.addItem = function (itemName) {
        var item = { name: itemName };
        items.push(item);
    };
    service.removeItem = function (itemIndex) {
        items.splice(itemIndex, 1);
    };
    service.getItems = function () { return items; };
}
function ShoppingListFactory() {
    var factory = {};
    var items = [];
    factory.addItem = function (itemName) {
        var item = { name: itemName };
        items.push(item);
    };
    factory.removeItem = function (itemIndex) {
        items.splice(itemIndex, 1);
    };
    factory.getItems = function () { return items; };
    return factory;
}
ShoppingListAddController.$inject = ['ShoppingListService', 'ShoppingListFactory'];
function ShoppingListAddController(ShoppingListService, ShoppingListFactory) {
    var itemAdder = this;
    itemAdder.addItem = function (itemName) {
        ShoppingListService.addItem(itemName);
        ShoppingListFactory.addItem(itemName);
    };
}
ShoppingListShowController.$inject = ['ShoppingListService', 'ShoppingListFactory'];
function ShoppingListShowController(ShoppingListService, ShoppingListFactory) {
    var showList = this;
    showList.items = ShoppingListService.getItems();
    showList.factoryItems = ShoppingListFactory.getItems();
    showList.removeItem = function (itemIndex) {
        ShoppingListService.removeItem(itemIndex);
        ShoppingListFactory.removeItem(itemIndex);
    };
}

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: './home.html'
        })
        .when('/review', {
            templateUrl: './review.html'
        })
        .when('/session', {
            templateUrl: './form.html'
        })
        .otherwise({
            redirectTo: '/'
        });
});

