<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Nota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>

  <body>
    <div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <h2>Gelora Technology</h2>
            <h4>Menjual Teknologi Canggih</h4>
            <h6>Jl. Ir. H.Juanda No. 106. Tasikmalaya</h6>
        </div>
        <div class="col-6">
            <h5>Tasimalaya, {{ $selling->date_sell}}</h5>
            <h5>Kepada Yth,</h5>
            <h5>{{$selling->customer->name}} - {{$selling->customer->email}}</h5>
            <h5>Cashier : {{$selling->cashier->name}}</h5>
        </div>
    </div>
    <div class="row">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Produck Name</th>
      <th scope="col">QTY</th>
      <th scope="col">Price</th>
      <th scope="col">Sub Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $selling->details as $key => $item)
    <tr>
      <th scope="row">{{ $key+1 }}</th>
      <td>{{ $item->product_name }}</td>
      <td>{{ $item->qty }}</td>
      <td class="text-end">{{ $item->selling_price }}</td>
      <td class="text-end">{{ $item->sub_total }}</td>
    </tr>
    @endforeach
    <tr>
              <td colspan="5" class ="text-end">Grand Total : Rp{{$selling->grand_total}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>

</html>