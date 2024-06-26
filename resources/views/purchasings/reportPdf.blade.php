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
    <div class="row text-center">
      <h2>Laporan Pembelian</h2>
    </div>
    <div class="row">
    <table class="table table-striped" id="purchasings">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NO TRX</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Vendor</th>
                                <th scope="col">Admin</th>
                                <th scope="col">Total Item</th>
                                <th scope="col">Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>

                            @foreach($purchasings as $row)
                            <?php $no++ ?>
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{$row->code_trans}}</td>
                                <td>{{$row->date_purchase}}</td>
                                <td>{{$row->vendor->name}}</td>
                                <td>{{$row->admin->name}}</td>
                                <td>{{$row->details->count()}}</td>
                                <td>{{$row->grand_total}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>

</html>