 <!-- Footer: Start -->
 <footer class="landing-footer bg-body footer-text">
   <div class="footer-top">
     <div class="container">
       <div class="row g-md-5">
         <div class="col-lg-4">
          <h6 class="footer-title text-uppercase"> Kwartir Nasional</h6>
           <p class="footer-text mb-4">
             Satuan organisasi yang mengelola Gerakan Pramuka tingkat nasional, dan 
             berkedudukan di Ibukota Negara,Jakarta
             <br><br>
             "Gerakan Pramuka Wadah Utama Pembentukan Kadar Pemimpin Bangsa"
           </p>
         </div>
         <div class="col-lg-5 col-md-4 col-sm-6 ms-lg-5">
           <h6 class="footer-title mb-4 text-uppercase">Sekretariat</h6>
           <p  class="footer-text mb-4">
            @foreach ($contact as $item)
            {{ $item->alamat }}<br>
            Email : {{ $item->email }} <br>
            Telfon : {{ $item->telepon }}  
            @endforeach
           </p>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-6">
           <h6 class="footer-title mb-4 text-uppercase">Media Sosial</h6>
           <ul class="list-unstyled justify-content-start d-flex">
             <li class="mb-3">
               <a href="" target="_blank" class="footer-link"><i class="ti ti-brand-twitter"></i></a>
             </li>
             <li class="mb-3">
               <a href="" target="_blank" class="footer-link"><i class="ti ti-brand-facebook"></i></a>
             </li>
             <li class="mb-3">
               <a href="" target="_blank" class="footer-link"><i class="ti ti-brand-youtube"></i></a>
             </li>
             <li class="mb-3">
               <a href="" target="_blank" class="footer-link"><i class="ti ti-brand-instagram"></i></a>
             </li>
           </ul>
         </div>
       </div>
       <div class="row mt-2">
          <div class="col-12">
              <hr>
              <p class="footer-text">© 2022 Company, Inc. All rights reserved.</p>
          </div>
       </div>
     </div>
   </div>
   
 </footer>
 <!-- Footer: End -->
