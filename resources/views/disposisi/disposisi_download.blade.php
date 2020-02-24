<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Nomor Aduan {{$disposisi->id_aduan}} (Konsumen : {{$disposisi->name}})</title>

    <style>
        .pdf-container {
            position: relative;
        }

        .header-wrapper {
            text-align: center;
            margin: 30px 0 45px 0;
            font-weight: bold;
            font-size: 16px;
        }

        .header-disposisi {
            text-align: center;
            margin: 30px 0 45px 0;
            font-weight: bold;
        }

        .kepada-yth {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pdf-container">
                <div class="header-wrapper">
                    FORMULIR TINDAK LANJUT
                    <br>
                    UNIT LAYANAN PENGADUAN KONSUMEN (ULPK)
                </div>
                <div class="box-body">
                    <div class="kepada-yth">
                        Kepada Yth. <br>
                        Kepala BBPOM Kota Pontianak
                    </div>
                    <br>
                    <div class="dl-horizontal">
                        <dt>
                            Nama Konsumen :
                        </dt>
                        <dd>
                            {{ $disposisi->name }}
                        </dd>
                        <dt>
                            Alamat :
                        </dt>
                        <dd>
                            {{ $disposisi->alamat }}
                        </dd>
                        <dt>
                            Telepon / HP :
                        </dt>
                        <dd>
                            {{ $disposisi->no_hp }}
                        </dd>
                        <dt>
                            Tanggal / Jam Pengaduan :
                        </dt>
                        <dd>
                            {{ $disposisi_aduan_created_at->created_at }}
                        </dd>
                        <dt>
                            Pengaduan / Keterangan :
                        </dt>
                        <dd>
                            {{ $disposisi->isi }}
                        </dd>
                    </div>

                    <br>
                    <br>
                    
                    <div>
                        <b>Petugas ULPK,</b>
                        <br>
                        <br>
                        <b>{{ $petugas->name }}</b>
                    </div>

                    <div class="header-disposisi">
                        <p>MOHON DISPOSISI TINDAK LANJUT</p>
                    </div>

                    <div class="dl-horizontal">
                        <dt>
                            Tanggal :
                        </dt>
                        <dd>
                            {{ $disposisi->created_at }}
                        </dd>
                        <dt>
                            Ditujukan Kepada :
                        </dt>
                        <dd>
                            1. {{ $disposisi->bidang }}
                        </dd>
                        <dd>
                            2. Bidang Informasi dan Komunikasi
                        </dd>
                        <dt>
                            Untuk Melakukan :
                        </dt>
                        <dd>
                            {{ $disposisi->note_disposisi }}
                        </dd>
                    </div>

                    <br>
                    <br>

                    <div>
                        <b>Kepala,</b>
                        <br>
                        <br>
                        <b>{{ $kepala->name }}</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>