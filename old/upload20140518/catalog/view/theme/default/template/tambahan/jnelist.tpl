
<h1>Resi JNE</h1>
<table width="100%" class="list">
<tr>
<thead>
<td class="left">Tanggal</td>
<td class="left">Nama</td>
<td class="left">Nomor Resi</td>
<td class="left">Kurir</td>
</tr>
</thead>
<?php foreach ($data as $data1) { ?>
<tbody>
<tr>
<td class="left"><?php echo $data1['tanggal']?></td>
<td class="left"><?php echo $data1['nama']?></td>
<td class="left"><?php echo $data1['noresi']?></td>
<td class="left"><?php echo $data1['kurir']?></td>
</tr>
</tbody>
<?php } ?>
</table>
