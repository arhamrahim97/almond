     @push('style')
         <style>
             .media {
                 box-shadow: 0px 10px 15px -3px rgba(0, 0, 0, 0.25) !important;
                 border: 1px solid grey;
                 border-radius: 10px;
                 padding: 15px;
             }

         </style>
     @endpush


     <ul class="list-unstyled">
         <label for="TextInput" class="form-label my-2">Daftar Dokumen :</label>
         <br>
         @foreach ($listDokumen as $dokumen)
             <li class="media mb-3 d-flex align-items-center">
                 <img src="{{ asset('assets/dashboard/img/pdf.png') }}" alt="" width="35px">
                 <div class="media-body">
                     <h5 class="font-16 mb-1 ml-2 my-0 fw-bold">{{ $dokumen->nama_dokumen }}<i
                             class="feather icon-download-cloud float-right"></i></h5>
                 </div>
                 <a href="{{ Storage::url('monitoring/' . $dokumen->dokumen) }}" class="btn btn-primary btn-sm"><i
                         class="fas fa-file-download"></i>
                     Lihat</a>
             </li>
         @endforeach
     </ul>
