<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT PRODUK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="produk_id">

                <div class="form-group">
                        <label for="id_kasir">Kasir</label>
                        <select class="form-control" id="id_kasir-edit" name="id_kasi-editr">
                            <option value="">Pilih Kasir</option>
                            @foreach($kasirs as $kasir)
                                <option value="{{ $kasir->id }}">{{ $kasir->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                <div class="form-group">
                    <label for="name" class="control-label">nama</label>
                    <input type="text" class="form-control" id="nama-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama-edit"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">deskripsi</label>
                    <textarea class="form-control" id="deskripsi-edit" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">image</label>
                    <input type="file" class="form-control" id="image-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">harga</label>
                    <input type="number" class="form-control" id="harga-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">stok</label>
                    <input type="number" class="form-control" id="stok-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-stok-edit"></div>
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
    //button create produk event
    $('body').on('click', '#btn-edit-produk', function () {

        let produk_id = $(this).data('id');

        //fetch detail produk with ajax
        $.ajax({
            url: `/produk/${produk_id}`,
            type: "GET",
            cache: false,
            success:function(response){

                //fill data to form
                $('#produk_id').val(response.data.id);
                $('#id_kasir-edit').val(response.data.id_kasir);
                $('#nama-edit').val(response.data.nama);
                $('#deskripsi-edit').val(response.data.deskripsi);
                // $('#image-edit').val(response.data.image);
                $('#harga-edit').val(response.data.harga);
                $('#stok-edit').val(response.data.stok);

                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });

    //action update produk
    $('#update').click(function(e) {
        e.preventDefault();

        //define variable
        let produk_id = $('#produk_id').val();
        let id_kasir   = $('#id_kasir-edit').val();
        let nama   = $('#nama-edit').val();
        let deskripsi   = $('#deskripsi-edit').val();
        let image   = $('#image-edit')[0].files[0];
        let harga   = $('#harga-edit').val();
        let stok = $('#stok-edit').val();
        let token   = $("meta[name='csrf-token']").attr("content");

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
    
        
        let formData = new FormData();
        formData.append('id_kasir',id_kasir);
        formData.append('nama',nama);
        formData.append('deskripsi',deskripsi);
        formData.append('image', image);
        formData.append('harga',harga);
        formData.append('stok', stok);
        formData.append('_token',token);
        formData.append('_method', 'PUT');
        
        $.ajax({

            url: `/produk/${produk_id}`,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            
            success:function(response){

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                
                //data produk
                let produk = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.id_kasir}</td>
                        <td>${response.data.nama}</td>
                        <td>${response.data.deskripsi}</td>
                        <td>${response.data.image}</td>
                        <td>${response.data.harga}</td>
                        <td>${response.data.stok}</td>
                        <td class="text-center">
                        <a href="javascript:void(0)" id="btn-edit-produk" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                        <a href="javascript:void(0)" id="btn-delete-produk" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                        </tr>
                        `;
                        
                        //append to produk data
                        $(`#index_${response.data.id}`).replaceWith(produk);
                        
                        //close modal
                        $('#modal-edit').modal('hide');
                        
                        
                    },
                    error: function(xhr, status, error) {
                console.log(xhr.responseText); // Tampilkan pesan kesalahan dalam konsol
            }
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