 <!-- boleta modal -->
 <div id="fotos-boleta" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-gray-700 rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t ">
               <h3 class="text-xl font-semibold text-white ">
                     Subir fotos de boleta
                 </h3>
                 <button type="button" class="text-gray-200 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="fotos-boleta">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
             </div>
             <!-- Modal body -->
            <div class="p-6 space-y-6">
                 <form action="{{ url('/tareas/fotos_boleta') }}" method="post" enctype="multipart/form-data"
                     id="imagen-boleta" class="dropzone">
                     @csrf
                     <input type="hidden" name="ticket" id="ticket" value="{{ $tarea->ticket }}" />
                     <input type="hidden" name="atm" id="atm" value="{{ $tarea->atm }}" />
                     <input type="hidden" name="tarea_id" id="tarea_id" value="{{ $tarea->id }}" />
                 </form>
             </div>
         </div>
     </div>
 </div>
 <script>
     new Dropzone("#imagen-boleta", {
         maxFilesize: 10000,
         acceptedFiles: "image/*,video/*",
         dictDefaultMessage: "Arrastra y suelta los archivos aqui o haz click aqui",
         maxThumbnailFilesize: 200,
         success(file) {
             if (file.previewElement) {
                 ObtenerImagenes()
                 return file.previewElement.classList.add("dz-success");
             }
         },
     })
 </script>
