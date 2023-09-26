$(document).ready(function(){

    // Bagian

    $(document).on("click", "#tambahBagian", function(){
        let form = $('#postBagian').serialize();
        $.ajax({
            url: "functions/tambah-data-bagian",
            data : form,
            type: 'POST',
            beforeSend: function() {
                $('#bagian').val('');
            },
            success: function(response){
                if (response.status) {
                    $(".tambahBagian").modal("hide");
                    $("#reset").load(location.href+" #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }                 
            },
            error: function(response){
                toastr.error(response.message);
            }
        });      
    });
    

    $(document).on("click", "#edit", function(){
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-bagian?idBagian=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response){
                if (response.status) {
                    let data = response.data;
                    for (let i = 0; i < data.length; i++) {
                        $("#editNamaBagian").val(data[i].nama_bagian)               
                        $(".editBagian").modal("show");
                    }
                }else{
                    toastr.error(response.message);
                }
            },
            error: function(response){
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#editBagian", function(e){
        let form = $('#postEditBagian').serialize();
        $.ajax({
            url: "functions/edit-bagian",
            data : form,
            type: 'POST',
            success: function(response){
                if (response.status) {
                    $(".editBagian").modal("hide");
                    $("#reset").load(location.href+" #reset>*", function() {
                        $('#table').DataTable();
                    });;    
                    toastr.info(response.message);
                }else{
                    toastr.error(response.message);
                }
            },
            error: function(response){
                toastr.error(response.message);
            }
        });   
    });

    $(document).on("click", "#hapus", function(){
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-bagian?idBagian=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response){
                let data = response.data;
                for (let i = 0; i < data.length; i++) {         
                    $(".hapusBagian").modal("show");
                }
            },
            error: function(response){
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#hapusBagian", function(e){
        $.ajax({
            url: "functions/delete-bagian",
            type: 'POST',
            success: function(response){
                if (response.status) {
                    $(".hapusBagian").modal("hide");
                    $("#reset").load(location.href+" #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.error(response.message);  
                }else{
                    toastr.error(response.message);
                }
            },
            error: function(response){
                toastr.error(response.message);
            }
        });   
    });
    
    // End Bagian

    // Barang

    $(document).on("click", "#tambahBarang", function(){
        let form = $('#postBarang').serialize();
        $.ajax({
            url: "functions/tambah-data-barang",
            data : form,
            type: 'POST',
            beforeSend: function() {
                $('#nama_barang').val('');
                $("#satuan").val('').trigger('change');
                $("#bagian_id").val('').trigger('change');        
                $('#type').val('');
                $('#merk').val('');
            },
            success: function(response){
                if (response.status) {
                    $(".tambahBarang").modal("hide");
                    $("#reset").load(location.href+" #reset>*", function() {
                        $('#table').DataTable();
                    });
                    $('#nama_barang').val('');
                    $('#type').val('');
                    $('#merk').val('');
                    toastr.success(response.message);
                }else{
                    toastr.error(response.message);
                }                 
            },
            error: function(response){
                toastr.error(response.message);
            }
        });      
    });

    $(document).on("click", "#btnEditBarang", function(){
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-barang?idBarang=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response){
                if (response.status) {
                    let data = response.data;
                    for (let i = 0; i < data.length; i++) {
                        $("#edit_nama_barang").val(data[i].nama_barang)        
                        $("#edit_satuan").val(data[i].satuan).trigger('change');
                        $("#edit_bagian_id").val(data[i].bagian_id).trigger('change');               
                        $("#edit_type").val(data[i].type)               
                        $("#edit_merk").val(data[i].merk)               
                        $(".editBarang").modal("show");
                    }
                }else{
                    toastr.error(response.message);
                }
            },
            error: function(response){
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#editBarang", function(e){
        let form = $('#postEditBarang').serialize();
        $.ajax({
            url: "functions/edit-barang",
            data : form,
            type: 'POST',
            success: function(response){
                if (response.status) {
                    $(".editBarang").modal("hide");
                    $("#reset").load(location.href+" #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.info(response.message);
                }else{
                    toastr.error(response.message);
                }
            },
            error: function(response){
                toastr.error(response.message);
            }
        });   
    });

    $(document).on("click", "#btnhapusBarang", function(){
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-barang?idBarang=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response){
                let data = response.data;
                for (let i = 0; i < data.length; i++) {         
                    $(".hapusBarang").modal("show");
                }
            },
            error: function(response){
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#hapusBarang", function(e){
        $.ajax({
            url: "functions/delete-barang",
            type: 'POST',
            success: function(response){
                if (response.status) {
                    $(".hapusBarang").modal("hide");
                    $("#reset").load(location.href+" #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.error(response.message);  
                }else{
                    toastr.error(response.message);
                }
            },
            error: function(response){
                toastr.error(response.message);
            }
        });   
    });
    
    // End Barang

    // Ruangan

    $(document).on("click", "#tambahRuangan", function(){
        let form = $('#postRuangan').serialize();
        $.ajax({
            url: "functions/tambah-data-ruangan",
            data : form,
            type: 'POST',
            beforeSend: function() {
                $('#nama_ruangan').val('');
                $('#lantai').val('').trigger('change');;
                $('#zona').val('').trigger('change');;
            },
            success: function(response){
                if (response.status) {
                    $(".tambahRuangan").modal("hide");
                    $("#reset").load(location.href+" #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.success(response.message);
                }else{
                    $(".tambahRuangan").modal("hide");
                    toastr.error(response.message);
                }                 
            },
            error: function(response){
                $(".tambahRuangan").modal("hide");
                toastr.error(response.message);
            }
        });      
    });

    $(document).on("click", "#btnEditRuangan", function(){
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-ruangan?idRuangan=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response){
                if (response.status) {
                    let data = response.data;
                    for (let i = 0; i < data.length; i++) {
                        $("#edit_nama_ruangan").val(data[i].nama_ruangan)        
                        $("#edit_lantai").val(data[i].lantai).trigger('change');
                        $("#edit_zona").val(data[i].zona).trigger('change');           
                        $(".editRuangan").modal("show");
                    }
                }else{      
                    toastr.error(response.message);
                }
            },
            error: function(response){
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#editRuangan", function(e){
        let form = $('#postEditRuangan').serialize();
        $.ajax({
            url: "functions/edit-ruangan",
            data : form,
            type: 'POST',
            success: function(response){
                if (response.status) {
                    $(".editRuangan").modal("hide");
                    $("#reset").load(location.href+" #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.info(response.message);
                }else{
                    $(".editRuangan").modal("hide");
                    toastr.error(response.message);
                }
            },
            error: function(response){
                $(".editRuangan").modal("hide");
                toastr.error(response.message);
            }
        });   
    });

    $(document).on("click", "#btnHapusRuangan", function(){
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-ruangan?idRuangan=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response){
                let data = response.data;
                for (let i = 0; i < data.length; i++) {         
                    $(".hapusBarang").modal("show");
                }
            },
            error: function(response){
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#hapusRuangan", function(e){
        $.ajax({
            url: "functions/delete-ruangan",
            type: 'POST',
            success: function(response){
                if (response.status) {
                    $(".hapusRuangan").modal("hide");
                    $("#reset").load(location.href+" #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.error(response.message);  
                }else{
                    $(".hapusRuangan").modal("hide");
                    toastr.error(response.message);
                }
            },
            error: function(response){
                $(".hapusRuangan").modal("hide");
                toastr.error(response.message);
            }
        });   
    });
    
    // End Ruangan

    // Teknisi

    $(document).on("click", "#tambahTeknisi", function(){
        let form = $('#postTeknisi').serialize();
        $.ajax({
            url: "functions/tambah-data-teknisi",
            data : form,
            type: 'POST',
            beforeSend: function() {
                $('#nama_teknisi').val('');
                $('#email').val('');
                $('#no_telp').val('');
                $('#bagian_id').val('').trigger('change');
                $('#no_nik').val('');
                $('#alamat').val('');
            },
            success: function(response){
                if (response.status) {
                    $(".tambahTeknisi").modal("hide");
                    $("#reset").load(location.href+" #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.success(response.message);
                }else{
                    $(".tambahTeknisi").modal("hide");
                    toastr.error(response.message);
                }                 
            },
            error: function(response){
                $(".tambahTeknisi").modal("hide");
                toastr.error(response.message);
            }
        });      
    });

    $(document).on("click", "#btnEditTeknisi", function(){
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-teknisi?idTeknis=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response){
                if (response.status) {
                    let data = response.data;
                    for (let i = 0; i < data.length; i++) {
                        $("#edit_nama_teknisi").val(data[i].nama_teknisi)        
                        $("#edit_email").val(data[i].email)
                        $("#edit_no_telp").val(data[i].no_telp)
                        $("#edit_bagian_id").val(data[i].bagian_id).trigger('change');
                        $("#edit_no_nik").val(data[i].no_nik)  
                        $("#edit_alamat").val(data[i].alamat)
                        $(".editTeknisi").modal("show");
                    }
                }else{      
                    toastr.error(response.message);
                }
            },
            error: function(response){
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#editTeknisi", function(){
        let form = $('#postEditTeknisi').serialize();
        $.ajax({
            url: "functions/edit-teknisi",
            data : form,
            type: 'POST',
            success: function(response){
                if (response.status) {
                    $(".editTeknisi").modal("hide");
                    $("#reset").load(location.href+" #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.info(response.message);
                }else{
                    $(".editTeknisi").modal("hide");
                    toastr.error(response.message);
                }
            },
            error: function(response){
                $(".editTeknisi").modal("hide");
                toastr.error(response.message);
            }
        });   
    });

    $(document).on("click", "#btnHapusTeknisi", function(){
        let id = $(this).data("id");
        $.ajax({
            url: "functions/get-id-teknisi?idTeknis=" + id,
            dataType: 'json',
            type: 'POST',
            success: function(response){
                let data = response.data;
                for (let i = 0; i < data.length; i++) {         
                    $(".hapusTeknisi").modal("show");
                }
            },
            error: function(response){
                toastr.error(response.message);
            }
        });
    });

    $(document).on("click", "#hapusTeknisi", function(e){
        $.ajax({
            url: "functions/delete-teknisi",
            type: 'POST',
            success: function(response){
                if (response.status) {
                    $(".hapusTeknisi").modal("hide");
                    $("#reset").load(location.href+" #reset>*", function() {
                        $('#table').DataTable();
                    });
                    toastr.error(response.message);  
                }else{
                    $(".hapusTeknisi").modal("hide");
                    toastr.error(response.message);
                }
            },
            error: function(response){
                $(".hapusTeknisi").modal("hide");
                toastr.error(response.message);
            }
        });   
    });
    
    // End Teknisi
});

$(".single-select").select2();
