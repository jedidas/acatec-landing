 <div class="contact-form-box">
     <form action="{{ route('api.contact') }}" method="post" id="contact-form" class="mb-5">
         @csrf
         <input type="hidden" name="token" class="token" />

         <div class="flex w-full flex-col gap-1 sm:flex-row sm:gap-4">
             <div class="mb-3 w-full md:w-1/2">
                 <label for="name" class="mb-2 block text-sm font-medium text-gray-900">{{ __('Nombre') }}</label>
                 <input type="text" id="name" name="name"
                     class="mb-1 block w-full rounded-sm border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                     placeholder="{{ __('john.doe') }}" required />
             </div>
             <div class="mb-3 w-full md:w-1/2">
                 <label for="email"
                     class="mb-2 block text-sm font-medium text-gray-900">{{ __('Correo electrónico') }}</label>
                 <input type="email" id="email" name="email"
                     class="mb-1 block w-full rounded-sm border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                     placeholder="{{ 'john.doe@' . env('reCAPTCHA_site_hostname') }}" required />
             </div>
         </div>

         <div class="flex w-full flex-col gap-1 sm:flex-row sm:gap-4">
             <div class="mb-3 w-full md:w-1/2">
                 <label for="phone" class="mb-2 block text-sm font-medium text-gray-900">{{ __('Teléfono') }}</label>
                 <input type="tel" id="phone" name="phone"
                     class="mb-1 block w-full rounded-sm border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                     placeholder="{{ __('Ingresa tu número de teléfono') }}" required />
             </div>
             <div class="mb-3 w-full md:w-1/2">
                 <label for="subject" class="mb-2 block text-sm font-medium text-gray-900">{{ __('Asunto') }}</label>
                 <input type="text" id="subject" name="subject"
                     class="mb-1 block w-full rounded-sm border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                     placeholder="{{ __('Breve descripción del asunto') }}" required />
             </div>
         </div>

         <div class="mb-6 w-full">
             <label for="message" class="mb-2 block text-sm font-medium text-gray-900">{{ __('Mensaje') }}</label>
             <textarea id="message" rows="4"
                 class="mb-1 block w-full rounded-sm border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:ring-blue-500"
                 placeholder="{{ __('Escribe tu mensaje aquí…') }}" name="message"></textarea>
         </div>

         <div class="control-wrapper">
             <button
                 class="m-0 h-12 w-full rounded-sm bg-gray-800 px-5 py-2.5 text-base font-medium text-white hover:bg-gray-900 focus:ring-4 focus:ring-gray-300 focus:outline-none"
                 type="submit">
                 {{ __('Enviar') }}
             </button>
         </div>
     </form>
     <div class="messageBox bg-white p-3 py-6">
         <p class="message text-center text-gray-700 text-sm font-bold">
             {{ __('Su mensaje ha sido recibido correctamente. Muchas gracias.') }}.
         </p>
         <p class="error text-center text-red-600 text-sm"></p>
     </div>
     <div class="sendingBox bg-white p-6 py-6"></div>
 </div>
