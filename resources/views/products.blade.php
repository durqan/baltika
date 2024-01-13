@extends('index')

@section('products')
    @if(!empty($products->isNotEmpty()))
        <table class="table table-striped-rows" style="margin: 20px 20px">
            <thead>
            <tr>
                <th scope="col">АРТИКУЛ</th>
                <th scope="col">НАЗВАНИЕ</th>
                <th scope="col">СТАТУС</th>
                <th scope="col">АТРИБУТЫ</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr class="table-light" data-id="{{$product->id}}" data-bs-toggle="modal"
                    data-bs-target="#productsCardModal">
                    <td>{{$product->article}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->status}}</td>
                    <td>
                        @if(!empty($product->data))
                            @foreach($product->data as $key => $val)
                                {{$key}} : {{$val}}<br>
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div style="margin: 50px 50px">
            <h1>Нет продуктов</h1>
        </div>
    @endif
@endsection
