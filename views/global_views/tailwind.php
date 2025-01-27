<style type="text/tailwindcss">
  @layer base {
    .content-auto {
      content-visibility: auto;
    }

    body {
      background-color: var(--primary);
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
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

    svg {
      @apply fill-blue-800 opacity-25 transition duration-300 ease-in-out;
    }
    svg:hover {
     @apply opacity-100;
    }

    .filter-container, #categories_container {
      @apply flex flex-col items-center justify-center;
    }

    .filter-container label,
    #categories_container label {
      @apply font-semibold text-white text-2xl
    }

    .filter-container > div,
    #categories_container > div {
      @apply w-[70%] flex items-center text-nowrap gap-4;
    }

    .filter-range-container input {
      -moz-appearance: textfield;
      @apply w-20 font-semibold text-xl p-2;
    }

    #is_favorite_meals_dropdown {
      @apply font-medium rounded-3xl py-2 px-4;
    }

    #submit-meal-filters-form-button {
      @apply px-6 py-4 font-bold bg-green-600 rounded-xl;
    }
  }
</style>