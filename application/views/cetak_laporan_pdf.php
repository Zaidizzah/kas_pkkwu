<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php $judul_laporan = explode('Pendataan', $judul); 
        if (trim($judul_laporan[0]) == 'Data Semua Laporan'){
            $pemasukan = true;
            $pengeluaran = true;
        } else{ 
            $pemasukan = false;
            $pengeluaran = false;
        }
    ?>
    <div style="background-color: #333; box-shadow: 0 0 25px rgba(0, 0, 0, 0.3); border: 2px blue solid; border-radius: 8px; padding: 10px; color: white;">
        <h1 style="text-align: center;"><?php
        $judul_laporan[0]; 
        $judul_laporan_baru = str_replace('Laporan', '<span style="color: yellow;">Laporan</span>', $judul_laporan[0]);
        echo $judul_laporan_baru;
        ?></h1>
        <div style="justify-content: space-between;"><?php $judul_laporan[1]; $rentang_tanggal = explode('tanggal', $judul_laporan[1]); ?>
            <?php if (isset($rentang_tanggal[1])): ?>
                <p style="margin-left: 5px;"><?php echo ucfirst($rentang_tanggal[0]); ?>:</p>
                <p style="margin-left: 5px;"><?php echo str_replace('sampai', '<span style="color: lightblue;">Sampai</span>', $rentang_tanggal[1]); ?></p>
            <?php endif;?>
        </div>
    </div>
    <hr>
    <div>
        <?php if ($laporan != null): ?>
            <table border="2px" style="width: 100%;">
                <thead>
                    <tr style="background-color: whitesmoke;">
                        <th>No</th>
                        <th>Username</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Tanggal pendataan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        
                        if (isset($laporan)):
                            foreach ($laporan as $lp):
                    ?>
                    <tr style="text-align: center;">
                        <td><?= $no++ ?></td>
                        <td><?= ucfirst($lp->username) ?></td>
                        <td><?= ucfirst($lp->keterangan) ?></td>
                        <td>Rp. <?= number_format($lp->nominal) ?>,00</td>
                        <td><?php if ($lp->jenis_transaksi == 'Pemasukan'){echo 'Pemasukan';}else{echo '---';} ?></td>
                        <td><?php if ($lp->jenis_transaksi == 'Pengeluaran'){echo 'Pengeluaran';}else{echo '---';} ?></td>
                        <td><?= $lp->tanggal ?></td>
                        <?php 
                            if (isset($data_pdt_pemasukan)){
                                $data_pdt_pemasukan += $lp->nominal; 
                            }
                            if (isset($data_pdt_pengeluaran)){
                                $data_pdt_pengeluaran += $lp->nominal;
                            }
                        ?>
                    </tr>
                    <?php
                            endforeach;
                            if ($pemasukan == true && $pengeluaran == true){ 
                                $total_pemasukan = $this->db->select_sum('nominal')->where('jenis_transaksi', 'Pemasukan')->get('transaksi')->row();
                                $total_pengeluaran = $this->db->select_sum('nominal')->where('jenis_transaksi', 'Pengeluaran')->get('transaksi')->row();
                                $data_saldo = $total_pemasukan->nominal - $total_pengeluaran->nominal;
                                ?>
                                <tr>
                                    <td>Saldo Akhir</td><td colspan="6"><?php if($data_saldo < 0){echo 'Rp 0,00 / '.number_format($data_saldo).',00';} else {echo 'Rp '.number_format($data_saldo).',00';} ?></td>
                                </tr>;
                            <?php }
                            if (isset($data_pdt_pemasukan)){
                                echo '<tr>
                                <td>Total Pemasukan</td><td colspan="6">Rp '.number_format($data_pdt_pemasukan).',00</td>
                                </tr>';
                            }
                            if (isset($data_pdt_pengeluaran)){
                                echo '<tr>
                                <td>Total Pengeluaran</td><td colspan="6">Rp '.number_format($data_pdt_pengeluaran).',00</td>
                                </tr>';
                            }
                        endif;

                        if ($laporan == null):
                    ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">Data Tidak Ditemukan</td>
                    </tr>
                    <?php
                        endif;
                    ?>
                </tbody>
            </table>
        <?php
        endif;
        if($laporan == null):
        ?>
        <h2 style="text-align: center; color: red;">Data Tidak Ditemukan</h2>
        <?php
        endif;
        ?>
    </div>
</body>
</html>