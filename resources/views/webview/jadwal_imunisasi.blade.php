<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  
</head>
<body>

<div class="container">
  <h2>Jadwal Imunisasi</h2>
  <!-- <p>Contextual classes can be used to color the table, table rows or table cells. The classes that can be used are: .table-primary, .table-success, .table-info, .table-warning, .table-danger, .table-active, .table-secondary, .table-light and .table-dark:</p> -->
  <table class="table">
    <thead>
      <tr>
        <th>Usia</th>  
        <th>Nama</th>        
        <th>Status</th>      
      </tr>
    </thead>
    <tbody>
      @foreach($jadwal as $j)
      <tr>
        <td>{{ $j->usia }}</td>
        <td>{{ $j->nama }}</td>        
        @if($j->status == 0)
        <td></td>
        @else
        <td><i class="fas fa-check"></i></td>
        @endif
        
      </tr>      
      @endforeach
    </tbody>
  </table>
</div>

</body>
</html>

