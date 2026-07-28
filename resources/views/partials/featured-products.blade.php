 @if ($products->count())
     <div class="pb-10">
         <ul class="gap-5 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
             @foreach ($products as $product)
                 <li>
                     @include('partials.product-item', [
                         'categoryName' => $product->category->slug,
                         'product' => $product,
                     ])
                 </li>
             @endforeach
         </ul>
     </div>
 @endif
