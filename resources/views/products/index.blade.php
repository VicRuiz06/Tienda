@extends('layouts.main')
@section('contenido')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
				<div class="card-header">
					Listado de productos
					<a href="{{ route('products.create') }}" class="btn btn-success btn-sm float-right">Nuevo producto</a>
				</div>
				<div class="card-body">
					@if(session('info'))
					<div class="alert alert-success">
						{{ session('info')}}
					</div>
						
					@endif
					<table class="table table-hover table-sm table-borderless">
						<thead>
							<th>Descripción</th>
							<th>Precio</th>
							<th>Acción</th>
						</thead>
						<tbody>
							@foreach($products as $product)
							<tr>
								<td>{{ $product->description }}</td>
								<td>{{ $product->price }}</td>
								<td>
									<a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Editar</a>
									<a href="javascript: document.getElementById('delete-{{ $product->id }}').submit()" class="btn btn-danger">Eliminar</a></td>
								<form id="delete-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST">
									@method('delete')
									@csrf
								</form>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="card-footer">
				<div class="card-footer">
				BIENVENIDO {{ auth()->user()->name }}
				<a href="javascript:document.getElementById('logout').submit()" class="btn btn-danger btn-sm float-right">Cerrar Sesión</a>
				<form action="{{ route('logout')  }}" method="POST" id="logout" style="display: none;">
				
					@csrf
				</form>
			</div>
			</div>
			</div>
			
			</div>
		</div>
	</div>
@endsection