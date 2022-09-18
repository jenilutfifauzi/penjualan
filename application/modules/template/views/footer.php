<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- jquery 3.6 -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?= base_url('assets/stisla-master/assets/js/stisla.js') ?>"></script>

<!-- JS Libraies -->
<!-- <script src="<?= base_url('assets/stisla-master/assets/js/bootstrap-modal.js') ?>"></script> -->
<!-- Template JS File -->
<script src="<?= base_url('assets/stisla-master/assets/js/scripts.js') ?>"></script>
<script src="<?= base_url('assets/stisla-master/assets/js/custom.js') ?>"></script>

<script type="text/javascript" src="<?= base_url('assets/jquery.idle/jquery.idle.js') ?>"></script>


<script>
    $(document).idle({
        onIdle: function() {
            window.location = "<?= base_url() ?>dashboard/logout";
        },
        idle: <?php foreach ($data_time as $data) { ?>
        <?php echo $data->time ?>
    <?php } ?>
    });
</script>



<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<!-- datatables filter script  -->


<!-- Page Specific JS File -->
</body>

</html>
<script>
    $(document).ready(function() {
        var i = 1;

        // Add form while clicking on add button
        $('#btn_add_license').click(function() {
            i++;
            $('#dynamic_field').append(
                ' <div class="row js-append lic_rows" id="first_row' + i +
                '" > <div class="form-group col-lg-5"> <input type="text" class=" form-control" name="nama_akun' +
                i +
                '" placeholder="Enter name" maxlength="35" class="form-control name_list" aria-required="true" /> </div><div class="form-group col-lg-5"> <input type="number" class="form-control" name="vEmail' +
                i +
                '" placeholder="Enter email" maxlength="35" class="form-control name_list" aria-required="true" /> </div><div class="form-group col-lg-2">  <button type="button" name="remove" id="' +
                i +
                '" class="btn btn-danger btn_remove">Remove</button>  </div>  </div>'
            );

            $('#license_count').val(i);
        });

        // remove license row on clicking remove btn
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#first_row' + button_id + '').remove();
            i--;
            $('#license_count').val(i);
        });
    });
</script>
<!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script> -->

<!-- <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bulma.min.js"></script
<!-- <script src="https://cdn.datatables.net/1.12.1/js/dataTables.semanticui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script> -->

<!-- <script type="text/javascript" src="<?= base_url('DataTables/datatables.min.js') ?>"></script> -->
<script>
    $(document).ready(function() {
        $('#tabel-data').dataTable({
            "language": {
                "emptyTable": "No data available in table"

            },
            "searching": true,
            "scrollX": true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#test').DataTable();
    });
</script>

<script>
    $(document).ready(function() {
        $('#tabel2').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabel3').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabel4').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabel5').DataTable();
    });
</script>
<script>
    $(document).ready(function() {

        //request data komponen
        $('#kode_komponen_baru').change(function() {
            var kode_komponen = $('#kode_komponen_baru').val(); //ambil value id dari provinsi

            if (kode_komponen != '') {
                $.ajax({
                    url: '<?= base_url(); ?>unit/get_nama_kom',
                    method: 'POST',
                    dataType: "text",
                    data: {
                        kode_komponen: kode_komponen
                    },
                    success: function(data) {
                        console.log("success data ", data);
                        //var result = JSON.parse(data);
                        //var tes = result.kegiatan;
                        //console.log(tes);
                        $('#nama_kom').html(data);
                    },
                    error: function(xhr, thrownError, ajaxOptions) {
                        console.log(xhr);
                        console.log(thrownError);
                        console.log(ajaxOptions);
                    }
                });
            }
        });

        //jika tombol kirim di klik
        $('#btnKirim').click(function() {
            var dataprov = $('#kode_komponen').val();
            var nama_kom = $('#nama_kom').val();
            var kecamatan = $('#kecamatan').val();
            var desa = $('#desa').val();
            $('#dataprov').html(dataprov);
            $('#nama_kom').html(nama_kom);
            $('#datakec').html(kecamatan);
            $('#datades').html(desa);
        });

    });
</script>
<script>
    $(document).ready(function() {

        //request data subkomponen
        $('#kode_subkomponen').change(function() {
            var kode_subkomponen = $('#kode_subkomponen').val(); //ambil value id dari kode_subkomponen

            if (kode_subkomponen != '') {
                $.ajax({
                    url: '<?= base_url(); ?>unit/komponen/get_nama_subkomponen',
                    method: 'POST',
                    dataType: "text",
                    data: {
                        kode_komponen: kode_subkomponen
                    },
                    success: function(data) {
                        console.log("success data ", data);
                        $('#nama_subkom').html(data);
                    },
                    error: function(xhr, thrownError, ajaxOptions) {
                        console.log(xhr);
                        console.log(thrownError);
                        console.log(ajaxOptions);
                    }
                });
            }
        });

        //req data detail
        $('#kode_detail').change(function() {
            var kode_detail = $('#kode_detail').val(); //ambil value id dari kode_detail
            console.log(kode_detail)

            if (kode_detail != '') {
                $.ajax({
                    url: '<?= base_url(); ?>unit/komponen/get_nama_detail',
                    method: 'POST',
                    dataType: "text",
                    data: {
                        kode_detail: kode_detail
                    },
                    success: function(data) {
                        console.log("success data ", data);
                        $('#nama_detail').html(data);
                    },
                    error: function(xhr, thrownError, ajaxOptions) {
                        console.log(xhr);
                        console.log(thrownError);
                        console.log(ajaxOptions);
                    }
                });
            }
        });

        //req data subkomponen
        $('#kode_detail').change(function() {
            var kode_detail = $('#kode_detail').val(); //ambil value id dari kode_detail
            console.log(kode_detail)

            if (kode_detail != '') {
                $.ajax({
                    url: '<?= base_url(); ?>unit/komponen/get_nama_subkomponen_detail',
                    method: 'POST',
                    dataType: "text",
                    data: {
                        kode_detail: kode_detail
                    },
                    success: function(data) {
                        console.log("success data ", data);
                        $('#getkode_subkomponen').html(data);
                    },
                    error: function(xhr, thrownError, ajaxOptions) {
                        console.log(xhr);
                        console.log(thrownError);
                        console.log(ajaxOptions);
                    }
                });
            }
        });


    });
</script>


<script>
    //define data
    var tabledata = [{
            id: 1,
            name: "Oli Bob",
            location: "United Kingdom",
            gender: "male",
            rating: 1,
            col: "red",
            dob: "14/04/1984"
        },
        {
            id: 2,
            name: "Mary May",
            location: "Germany",
            gender: "female",
            rating: 2,
            col: "blue",
            dob: "14/05/1982"
        },
        {
            id: 3,
            name: "Christine Lobowski",
            location: "France",
            gender: "female",
            rating: 0,
            col: "green",
            dob: "22/05/1982"
        },
        {
            id: 4,
            name: "Brendon Philips",
            location: "USA",
            gender: "male",
            rating: 1,
            col: "orange",
            dob: "01/08/1980"
        },
        {
            id: 5,
            name: "Margret Marmajuke",
            location: "Canada",
            gender: "female",
            rating: 5,
            col: "yellow",
            dob: "31/01/1999"
        },
        {
            id: 6,
            name: "Frank Harbours",
            location: "Russia",
            gender: "male",
            rating: 4,
            col: "red",
            dob: "12/05/1966"
        },
        {
            id: 7,
            name: "Jamie Newhart",
            location: "India",
            gender: "male",
            rating: 3,
            col: "green",
            dob: "14/05/1985"
        },
        {
            id: 8,
            name: "Gemma Jane",
            location: "China",
            gender: "female",
            rating: 0,
            col: "red",
            dob: "22/05/1982"
        },
        {
            id: 9,
            name: "Emily Sykes",
            location: "South Korea",
            gender: "female",
            rating: 1,
            col: "maroon",
            dob: "11/11/1970"
        },
        {
            id: 10,
            name: "James Newman",
            location: "Japan",
            gender: "male",
            rating: 5,
            col: "red",
            dob: "22/03/1998"
        },
    ];

    var table = new Tabulator("#example-table", {
        data:tabledata,
        height: "311px",
        layout: "fitColumns",
        responsiveLayout: "collapse",
        resizableColumnFit:true,
        columns: [  
            {
                title: "Name",
                field: "name",
                width: 200,
                resizable:true,
                responsive: 0
            },
            {
                title: "Progress",
                field: "progress",
                hozAlign: "right",
                sorter: "number",
                width: 150,
                resizable:true
            },
            {
                title: "Gender",
                field: "gender",
                width: 150,
                responsive: 2,
                resizable:true
            },
            {
                title: "Rating",
                field: "rating",
                hozAlign: "center",
                width: 150,
                resizable:true
            },
            {
                title: "Favourite Color",
                field: "col",
                width: 150,
                resizable:true
            },
            {
                title: "Date Of Birth",
                field: "dob",
                hozAlign: "center",
                sorter: "date",
                width: 150,
                resizable:true
            },
            {
                title: "Driver",
                field: "car",
                hozAlign: "center",
                width: 150,
                resizable:true
            },
        ],
    });
</script>