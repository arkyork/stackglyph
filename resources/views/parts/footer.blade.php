<footer class="bg-white border-t border-gray-200 text-center text-sm text-gray-500 py-4">
  <!-- SNSアイコン（上段） -->
  <div class="mb-2">
    <a href="https://x.com/KasaneMoji" 
       target="_blank" 
       class="hover:text-blue-500 transition inline-block">
      <svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 24 24">
        <path d="M18.89 2H21.7l-7.59 8.68 8.92 11.32h-7.05l-5.53-7.04L4.63 22H1.8l8.08-9.24L1.2 2h7.26l4.84 6.16L18.89 2zm-2.48 19.13h1.94L6.1 3.2H4.03l12.38 17.93z"/>
      </svg>
    </a>
  </div>
    <!-- GitHub -->
    <a href="https://github.com/arkyork/stackglyph" 
       target="_blank" 
       class="hover:text-blue-500 transition inline-block">
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 0C5.37 0 0 5.4 0 12.07c0 5.33 3.44 9.84 8.2 11.44.6.11.82-.26.82-.58v-2.17c-3.34.73-4.04-1.62-4.04-1.62-.55-1.41-1.35-1.79-1.35-1.79-1.1-.76.08-.75.08-.75 1.22.09 1.86 1.28 1.86 1.28 1.08 1.88 2.83 1.34 3.52 1.03.11-.8.42-1.34.76-1.64-2.66-.3-5.46-1.36-5.46-6.04 0-1.34.47-2.44 1.25-3.3-.13-.31-.54-1.54.12-3.22 0 0 1.01-.32 3.3 1.24a11.34 11.34 0 0 1 6 0c2.3-1.56 3.3-1.24 3.3-1.24.66 1.68.25 2.9.12 3.22.78.86 1.25 1.96 1.25 3.3 0 4.7-2.8 5.73-5.48 6.03.44.38.82 1.11.82 2.24v3.32c0 .32.22.7.82.58C20.57 21.9 24 17.4 24 12.07 24 5.4 18.63 0 12 0z"/>
      </svg>
    </a>
  <!-- テキストリンク（中段） -->
  <div class="space-x-4 mb-2">
    <a href="{{ route('howto') }}" class="hover:text-blue-500 transition">遊び方</a>
    <a href="{{ route('policy') }}" class="hover:text-blue-500 transition">プライバシーポリシー</a>
  </div>

  <!-- コピーライト（下段） -->
  &copy; {{ date('Y') }} KasaneMoji Game
</footer>
