<!DOCTYPE html>
<html>
   <head></head>
   <body>
      <p style="text-align: center;"><strong>DOKTER NAUFAL BARAS, M.Sc. Sp.A</strong></p>
      <hr />
      <table style="border-collapse: collapse; width: 100%; height: 80px;" border="0">
         <tbody>
            <tr style="height: 100px;">
               <td style="width: 50%; height: 80px;">
                  <p>Praktek:</p>
                  <p>Jl.xxx xxxx xxxx</p>
                  <p>Banyuwangi</p>
                  <p>Telp : 000000</p>
               </td>
               <td style="width: 50%; height: 80px;">
                  <p>Pagi : 00 s/d 00</p>
                  <p>Sore : 00 s/d 00</p>                  
               </td>
            </tr>
         </tbody>
      </table>
      <table style="border-collapse: collapse; width: 100%;" border="1">
         <tbody>
            <tr>
               <td style="width: 100%; text-align: center;">
                  <p>Resep</p>
                  
                  {!! nl2br($resep->resep) !!}
               </td>
            </tr>
         </tbody>
      </table>
      <table style="border-collapse: collapse; width: 100%;" border="1">
         <tbody>
            <tr>
               <td >
                  <p>Tanggal : {{ $resep->tanggal }}</p>
                  <p>Nama Pasien : {{ $resep->nama }}</p>                  
                  <p>Usia : {{ $resep->usia }}&nbsp;Bulan</p>
               </td>
               
               
            </tr>
         </tbody>
      </table>
   </body>
</html>