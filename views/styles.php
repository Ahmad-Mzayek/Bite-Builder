<style type="text/tailwindcss">
  @layer base {
    .content-auto {
      content-visibility: auto;
  }
  body {
	  background-color: var(--primary);
  }
  .light {
	  --primary: #ffffff;
  }
  .dark {
	  --primary: #000000;
  }
  h1 {
	  @apply font-extrabold text-xl md:text-2xl lg:text-3xl
  }
  h2 {
	  @apply font-bold text-lg md:text-xl lg:text-2xl
  }
  h3 {
	  @apply font-medium text-base md:text-lg lg:text-xl
  }
  button {
	  @apply text-sm cursor-pointer md:text-base lg:text-lg text-nowrap
  }
  input[type="text"],
  input[type="password"],
  input[type="email"] {
	  @apply p-2 w-full rounded-xl appearance-none border-2 text-lg md:text-xl lg:text-xl
  }
  input[type="submit"] {
	  @apply bg-blue-800 text-white px-6 py-4 text-nowrap transition hover:bg-blue-900 cursor-pointer rounded-lg text-lg md:text-xl lg:text-xl tracking-[.1rem]
  }
}
</style>