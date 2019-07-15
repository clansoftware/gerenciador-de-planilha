/* controla os eventos de click e show, 
	na seleção de persistência dos 
	dados de uma planilha em banco de dados*/

var app = angular.module('persistenciaApp', []);
	app.controller('persistenciaCtrl', function($scope) {
	  $scope.firstName= "John";
	  $scope.lastName= "Doe";
	});


/**
	* controla os display todo, show and hide na tela de externos na instalação
*/
var externo = angular.module("myModule", []);
	externo.controller("myController", function ($scope) {
	var employees = [{
			name: "Ben",
			gender: "Male",
			city: "London",
			salary: 55000 
		},{
			name: "Sara",
			gender: "Female",
			city: "Chennai",
			salary: 68000
		},{
			name: "Mark",
			gender: "Male",
			city: "Chicago",
			salary: 57000
		},{
			name: "Pam",
			gender: "Female",
			city: "London",
			salary: 53000
		},
		{
			name: "Todd",
			gender: "Male",
			city: "Chennai",
			salary: 60000
		}];
		$scope.employees = employees;
	});