<script>
var table;
$(document).ready(function() {
    $('.select2').select2();
    loadtable();
});

function loadtable() {
    //datatables
    table = $('#dtable').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'columns': [
            null,
            null,
            null,
            null,
            {
                'width': '50px'
            },
        ],
        'bDestroy': true,
        'processing': true, //Feature control the processing indicator.\
        'serverSide': true, //Feature control DataTables' server-side processing mode.\
        'order': [], //Initial no order.

        // Load data for the table's content from an Ajax source
        'ajax': {
            'url': "<?= site_url('histori/ajax_list/') ?>",
            'type': "POST",
        },

        //Set column definition initialisation properties.
        'columnDefs': [{
            'targets': [0], //first column / numbering column
            'orderable': false, //set not orderable
        }, ],

    });
}


function showArea(param) {
    param = decodeURIComponent(param);
    param = JSON.parse(param);
    var a_id = param.after[0];
    var a_nama = param.after[1];
    var a_alamat = param.after[2];
    var a_telp = param.after[3];
    var a_kordinat = param.after[4];
    var a_tahun = param.after[5];

    if (param.before != null){
        var b_id = param.before[0];
        var b_nama = param.before[1];
        var b_alamat = param.before[2];
        var b_telp = param.before[3];
        var b_kordinat = param.before[4];
        var b_tahun = param.before[5];

        $('#b_kode_area').html(b_id);
        $('#b_nama_area').html(b_nama);
        $('#b_alamat_area').html(b_alamat);
        $('#b_telp_area').html(b_telp);
        $('#b_kordinat_area').html(b_kordinat);
        $('#b_tahun_area').html(b_tahun);
    }
    

    $('#user').html("User : " + param.user);
    $('#tabel').html("Tabel : " + param.tabel);

    $('#desc_before').hide();
    $('#desc_after').hide();
    $('#before').hide();
    if (param.tipe=="update"){
    $('#desc_before').show();
        $('#desc_after').show();
        $('#desc').html("UPDATE DATA");
        $('#after').show();    
        $('#before').show();
    }else if(param.tipe=="insert"){
        $('#desc').html("INSERT DATA");
    }else{
        $('#desc').html("DELETE DATA");

    }
    $('#a_kode_area').html(a_id);
    $('#a_nama_area').html(a_nama);
    $('#a_alamat_area').html(a_alamat);
    $('#a_telp_area').html(a_telp);
    $('#a_kordinat_area').html(a_kordinat);
    $('#a_tahun_area').html(a_tahun);


    

    $('#modal-show-area').modal();
}
function showKriteria(param) {
    param = decodeURIComponent(param);
    param = JSON.parse(param);
    var a_id = param.after[0];
    var a_nama = param.after[1];
    var a_bobot = param.after[2];
    var a_tahun = param.after[3];

    if (param.before != null){
        var b_id = param.before[0];
        var b_nama = param.before[1];
        var b_bobot = param.before[2];
        var b_tahun = param.before[3];

        $('#b_kode_kriteria').html(b_id);
        $('#b_nama_kriteria').html(b_nama);
        $('#b_bobot_kriteria').html(b_bobot);
        $('#b_tahun_kriteria').html(b_tahun);
    }
    

    $('#user_kriteria').html("User : " + param.user);
    $('#tabel_kriteria').html("Tabel : " + param.tabel);

    $('#desc_before_kriteria').hide();
    $('#desc_after_kriteria').hide();
    $('#before_kriteria').hide();
    if (param.tipe=="update"){
    $('#desc_before_kriteria').show();
        $('#desc_after_kriteria').show();
        $('#desc_kriteria').html("UPDATE DATA");
        $('#after_kriteria').show();    
        $('#before_kriteria').show();
    }else if(param.tipe=="insert"){
        $('#desc_kriteria').html("INSERT DATA");
    }else{
        $('#desc_kriteria').html("DELETE DATA");

    }

        $('#a_kode_kriteria').html(a_id);
        $('#a_nama_kriteria').html(a_nama);
        $('#a_bobot_kriteria').html(a_bobot);
        $('#a_tahun_kriteria').html(a_tahun);


    

    $('#modal-show-kriteria').modal();
}
function showNilai(param) {
    param = decodeURIComponent(param);
    param = JSON.parse(param);

    var a_kode_area = param.after[0];
    var a_nama_area = param.after[1];
    var a_kode_kriteria = param.after[2];
    var a_nama_kriteria = param.after[3];
    var a_nilai = param.after[4];

    if (param.before != null){
        var b_kode_area = param.before[0];
        var b_nama_area = param.before[1];
        var b_kode_kriteria = param.before[2];
        var b_nama_kriteria = param.before[3];
        var b_nilai = param.before[4];

        $('#b_kode_kriteria_nilai').html(b_kode_kriteria);
        $('#b_nama_kriteria_nilai').html(b_nama_kriteria);
        $('#b_kode_area_nilai').html(b_kode_area);
        $('#b_nama_area_nilai').html(b_nama_area);
        $('#b_nilai_nilai').html(b_nilai);
    }
    

    $('#user_nilai').html("User : " + param.user);
    $('#tabel_nilai').html("Tabel : " + param.tabel);

    $('#desc_before_nilai').hide();
    $('#desc_after_nilai').hide();
    $('#before_nilai').hide();
    if (param.tipe=="update"){
    $('#desc_before_nilai').show();
        $('#desc_after_nilai').show();
        $('#desc_nilai').html("UPDATE DATA");
        $('#after_nilai').show();    
        $('#before_nilai').show();
    }else if(param.tipe=="insert"){
        $('#desc_nilai').html("INSERT DATA");
    }else{
        $('#desc_nilai').html("DELETE DATA");

    }

        $('#a_kode_kriteria_nilai').html(a_kode_kriteria);
        $('#a_nama_kriteria_nilai').html(a_nama_kriteria);
        $('#a_kode_area_nilai').html(a_kode_area);
        $('#a_nama_area_nilai').html(a_nama_area);
        $('#a_nilai_nilai').html(a_nilai);


    

    $('#modal-show-nilai').modal();
}
function b64_to_utf8( str ) {
  return decodeURIComponent(escape(window.atob( str )));
}
</script>