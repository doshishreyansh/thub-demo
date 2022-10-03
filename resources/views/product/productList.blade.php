@extends('layout.layout')
@section('content')
<div class="cont">
    <h1>Product List</h1>
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered" id="dt-product-list">
            <thead>
                <tr>
                    <th>#id</th>
                    <th>Species</th>
                    <th>Grade</th>
                    <th>Drying Methods</th>
                    <th>Treatment</th>
                    <th>Dimentions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->species}}</td>
                    <td>{{($product->grade_system==1)?"Nordic Blue":"Tegernseer"}}/{{$product->grade}}</td>
                    <td>{{$product->drying_method}}</td>
                    <td>{{$product->treatment}}</td>
                    <td>{{$product->thickness}} x {{$product->width}} x {{$product->length}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('jsscript')
<script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    let products = <?php echo json_encode($products); ?>;

    $(document).ready(function() {
        $('#dt-product-list').DataTable({
            "pageLength": 50,
            "ordering": false
        });      
    });
</script>
@endsection