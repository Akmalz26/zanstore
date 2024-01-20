<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="user_id">

                <div class="form-group">
                    <label for="name" class="control-label">name</label>
                    <input type="text" class="form-control" id="name-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">alamat</label>
                    <textarea class="form-control" id="alamat-edit" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">nohp</label>
                    <input type="number" class="form-control" id="nohp-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nohp-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">email</label>
                    <input type="text" class="form-control" id="email-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email-edit"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="update">UPDATE</button>
            </div>
        </div>
    </div>
</div>

<script>
    //button create user event
    $('body').on('click', '#btn-edit-user', function () {

        let user_id = $(this).data('id');

        //fetch detail user with ajax
        $.ajax({
            url: `/pembeli/${user_id}`,
            type: "GET",
            cache: false,
            success:function(response){ 

                //fill data to form
                $('#user_id').val(response.data.id);
                $('#name-edit').val(response.data.name);
                $('#alamat-edit').val(response.data.alamat);
                $('#nohp-edit').val(response.data.nohp);
                $('#email-edit').val(response.data.email);

                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });

    //action update user
    $('#update').click(function(e) {
        e.preventDefault();

        //define variable
        let user_id = $('#user_id').val();
        let name   = $('#name-edit').val();
        let alamat   = $('#alamat-edit').val();
        let nohp   = $('#nohp-edit').val();
        let email   = $('#email-edit').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/user/${user_id}`,
            type: "PUT",
            cache: false,
            data: {
                "name": name,
                "alamat": alamat,
                "nohp": nohp,
                "email": email,
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

                //data user
                let user = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.name}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.nohp}</td>
                        <td>${response.data.email}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-user" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-user" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                
                //append to user data
                $(`#index_${response.data.id}`).replaceWith(user);

                //close modal
                $('#modal-edit').modal('hide');
                

            },
            // error:function(error){
                
            //     if(error.responseJSON.title[0]) {

            //         //show alert
            //         $('#alert-title-edit').removeClass('d-none');
            //         $('#alert-title-edit').addClass('d-block');

            //         //add message to alert
            //         $('#alert-title-edit').html(error.responseJSON.title[0]);
            //     } 

            //     if(error.responseJSON.content[0]) {

            //         //show alert
            //         $('#alert-content-edit').removeClass('d-none');
            //         $('#alert-content-edit').addClass('d-block');

            //         //add message to alert
            //         $('#alert-content-edit').html(error.responseJSON.content[0]);
            //     } 

            // }

        });

    });

</script>