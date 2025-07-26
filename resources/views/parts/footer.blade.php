<footer class="bg-white border-t border-gray-200 text-center text-sm text-gray-500 py-4">
  <!-- SNSアイコン（上段） -->
  <div class="flex gap-4 justify-center mb-2">
    <div class="self-center">
      <a href="https://x.com/KasaneMoji" 
        target="_blank" 
        class="hover:text-blue-500 transition inline-block">
        <svg class="w-7 mx-auto" fill="currentColor" viewBox="0 0 24 24">
          <path d="M18.89 2H21.7l-7.59 8.68 8.92 11.32h-7.05l-5.53-7.04L4.63 22H1.8l8.08-9.24L1.2 2h7.26l4.84 6.16L18.89 2zm-2.48 19.13h1.94L6.1 3.2H4.03l12.38 17.93z"/>
        </svg>
      </a>
    </div>
    <div class="">
      <a href="https://note.com/stackglyph" 
        target="_blank" >
        <img src={{url('social_icons/square.svg')}} alt="note"  class="h-14">
      </a>
    </div>
  </div>


  <!-- テキストリンク（中段） -->
  <div class="space-x-4 mb-2">
    <a href="{{ route('howto') }}" class="hover:text-blue-500 transition">遊び方</a>
    <a href="{{ route('policy') }}" class="hover:text-blue-500 transition">プライバシーポリシー</a>
  </div>

  <!-- コピーライト（下段） -->
  &copy; {{ date('Y') }} KasaneMoji Game
</footer>
