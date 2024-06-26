@extends('admin.layout')

@section('main')

	<h1>
		<a href="/master" class="glyphicon glyphicon-circle-arrow-left"></a>

		<a href="/master/pages/{{ $type }}/add" class="glyphicon glyphicon-plus-sign"></a>

		{{ $title }}<span class="label label-default">{{ count( array($pages )) }} {{ Lang::choice('страница|страницы|страниц', count( array($pages) ) , array(), 'ru') }} </span></h1>

		{!! Form::open() !!}
			@if( count(array( $pages))>0 )
				<table class="table">
					<tr>
						<th style="width: 30%;">Название</th>
						<th style="text-align: right;">Управление</th>
					</tr>
				</table>

					<div ng-app="treeApp">
						<div ng-controller="treeCtrl">

							<script type="text/ng-template" id="nodes_renderer.html">
								<div class="tree-node">
								  <div class="pull-left tree-handle" ui-tree-handle>
									<span class="glyphicon glyphicon-list"></span>
								  </div>
								  <div class="tree-node-content">
									<!--<a class="btn btn-success btn-xs" ng-if="node.children && node.children.length > 0" nodrag ng-click="toggle(this)"><span class="glyphicon" ng-class="{'glyphicon-chevron-right': collapsed, 'glyphicon-chevron-down': !collapsed}"></span></a>//-->
									<div style="display: inline-block; margin-right: 9px;"> <input name="check[]" type="checkbox" value="[[node.id]]"></div><a class="black_link" href="/master/pages/[[node.type]]/edit/[[node.id]]">[[node.name]]</a>
									<div class="pull-right btn-group" style="margin-top: -6px; margin-right: -5px;">
										<a title="Редактировать" href="/master/pages/[[node.type]]/edit/[[node.id]]" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a>
										<a title="Открыть в новом окне" target="_blank" href="/[[node.slug]]" class="btn btn-primary"><span class="glyphicon glyphicon-new-window"></span></a>
									</div>
								  </div>
								</div>
								<ol ui-tree-nodes="" ng-model="node.children" ng-class="{hidden: collapsed}">
								  <li ng-repeat="node in node.children" ui-tree-node ng-include="'nodes_renderer.html'">
								  </li>
								</ol>
							</script>

							<div ui-tree="dataOptions" data-max-depth="1" id="tree-root" >
							  <ol ui-tree-nodes ng-model="data">
								<li ng-repeat="node in data" ui-tree-node ng-include="'nodes_renderer.html'"></li>
							  </ol>
							</div>
						</div>
					</div>

				<div class="select_form">
					<label id="check_all" class="link">Выбрать все</label>
					<select name="action" class="form-control">
						<option value="delete">удалить</option>
					</select>
					<button type="submit" style="margin-left: 20px;" class="btn btn-success">Применить</button>
				</div>
			@else
				<div class="alert alert-warning" role="alert">
				 Нет записей
				</div>
			@endif
		{!! Form::close() !!}

@endsection

@section('scripts')
	<script src="/dashboard/bower_components/angular/angular.min.js"></script>
	<script src="/dashboard/bower_components/angular/angular-ui-tree.min.js"></script>

	<script>

	(function() {
	  'use strict';

		var app = angular.module('treeApp', ['ui.tree'], function($interpolateProvider) {
			$interpolateProvider.startSymbol('[[');
			$interpolateProvider.endSymbol(']]');
		});
		
		app.controller('treeCtrl', function($scope, $http) {

			$scope.data = {!!$pages!!}

			$scope.dataOptions = {
				dropped: function(event) {
				
					$http.post('/master/pages/{{ $type }}', { _token: '{{ Session::token() }}', data: $scope.data, action: 'rebuild' }).
					  success(function(data, status, headers, config) {
						console.log(data);
					  }).
					  error(function(data, status, headers, config) {
						alert('error');
					});
				}
			};
		});
	 })();



	 $(function() {

		// удаление записи
		$('.delete').click( function() {
			$('input[type="checkbox"][name*="check"]').prop('checked', false);
			$(this).closest("tr").find('input[type="checkbox"][name*="check"]').prop('checked', true);
			$(this).closest("form").find('select[name="action"] option[value=delete]').prop('selected', true);
			$(this).closest("form").submit();
		})
		
		// удаление записей
		$("form").submit(function() {
			if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление записи'))
				return false;
		});
		
		// выделить все
		$("#check_all").on( 'click', function() {
			$('input[type="checkbox"][name*="check"]').prop('checked', $('input[type="checkbox"][name*="check"]:not(:checked)').length>0 );
		});
	})
	</script>
@endsection