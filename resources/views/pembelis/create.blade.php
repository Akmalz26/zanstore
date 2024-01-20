<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH PEMBELI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> 
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name" class="control-label">Nama</label>
                    <input type="text" class="form-control" id="nama">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                </div>
                

                <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">No Telpon</label>
                    <input type="number" class="form-control" id="tlp">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tlp"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Email</label>
                    <input type="text" class="form-control" id="email">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Pssword</label>
                    <input type="password" class="form-control" id="password">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="store">SIMPAN</button>
            </div>
        </div>
    </div>
</div>

<script>
    //button create pembeli event
    $('body').on('click', '#btn-create-pembeli', function () {

        //open modal
        $('#modal-create').modal('show');
    });

    //action create pembeli
    $('#store').click(function(e) {
        e.preventDefault();

        //define variable
        let nama   = $('#nama').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let alamat = $('#alamat').val();
        let tlp = $('#tlp').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/pembelis`,
            type: "POST",
            cache: false,
            data: {
                "nama": nama,
                "email": email,
                "password": password,
                "alamat": alamat,
                "tlp": tlp,
                "_token": token
            },
            success:function(response){

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                

                //data pembeli
                let pembeli = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.tlp}</td>
                        <td>${response.data.email}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-pembeli" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-pembeli" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                
                //append to table
                $('#table-pembelis').prepend(pembeli);
                
                //clear form
                $('#nama').val('');
                $('#email').val('');
                $('#password').val('');
                $('#alamat').val('');
                $('#tlp').val('');

                //close modal
                $('#modal-create').modal('hide');
                

            },

            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Tampilkan pesan kesalahan dalam konsol
            }

            // error: function (error) {
            //     // Tampilkan pesan kesalahan validasi atau email sudah ada
            //     var errors = error.responseJSON.errors;
            //     if ('email' in errors) {
            //         Swal.fire({
            //             icon: 'error',
            //             title: 'Oops...',
            //             text: 'Email sudah ada dalam basis data.',
            //         });
            //     } else {
            //         $.each(errors, function (key, value) {
            //             Swal.fire({
            //                 icon: 'error',
            //                 title: 'Oops...',
            //                 text: value[0],
            //             });
            //         });
            //     }

                
            // }
            // error:function(error){
                
            //     if(error.responseJSON.nama[0]) {

            //         //show alert
            //         $('#alert-nama').removeClass('d-none');
            //         $('#alert-nama').addClass('d-block');

            //         //add message to alert
            //         $('#alert-nama').html(error.responseJSON.nama[0]);
            //     } 

            //     if(error.responseJSON.alamat[0]) {

            //         //show alert
            //         $('#alert-alamat').removeClass('d-none');
            //         $('#alert-alamat').addClass('d-block');

            //         //add message to alert
            //         $('#alert-alamat').html(error.responseJSON.alamat[0]);
            //     } 

            //     if(error.responseJSON.tlp[0]) {

            //         //show alert
            //         $('#alert-tlp').removeClass('d-none');
            //         $('#alert-tlp').addClass('d-block');

            //         //add message to alert
            //         $('#alert-tlp').html(error.responseJSON.tlp[0]);
            //     } 

            //     if(error.responseJSON.email[0]) {

            //         //show alert
            //         $('#alert-email').removeClass('d-none');
            //         $('#alert-email').addClass('d-block');

            //         //add message to alert
            //         $('#alert-email').html(error.responseJSON.email[0]);
            //     } 

            // }

        });

    });

</script>