<style type="text/tailwindcss">
  @layer base {
  html {
    @apply scroll-smooth;
  }
  
  body {
    @apply overflow-x-hidden;
  }

  .content-auto {
    content-visibility: auto;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  h1 {
    @apply font-extrabold text-xl md:text-2xl lg:text-3xl;
  }

  h2 {
    @apply font-bold text-lg md:text-xl lg:text-2xl;
  }

  h3 {
    @apply font-medium text-base md:text-lg lg:text-xl;
  }

  button {
    @apply text-sm cursor-pointer md:text-base rounded-full lg:text-lg text-nowrap;
  }
  
  input[type="text"],
  input[type="password"],
  input[type="email"] {
    @apply p-2 px-4 w-full appearance-none rounded-full border-2 text-lg md:text-xl lg:text-xl;
  }

  input[type="submit"] {
    @apply text-lg cursor-pointer;
  }

  #meal-search-input {
    @apply pl-11;
  }

  svg {
    @apply transition duration-300 ease-in-out;
  }
  
  .leap-frog {
    --uib-size: 40px;
    --uib-speed: 2s;
    --uib-color: rgb(37, 37, 149);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: var(--uib-size);
    height: var(--uib-size);
  }

  .leap-frog__dot {
    position: absolute;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 100%;
    height: 100%;
  }

  .leap-frog__dot::before {
    content: '';
    display: block;
    height: calc(var(--uib-size) * 0.22);
    width: calc(var(--uib-size) * 0.22);
    border-radius: 50%;
    background-color: var(--uib-color);
    will-change: transform;
  }

  .leap-frog__dot:nth-child(1) {
    animation: leapFrog var(--uib-speed) ease infinite;
  }

  .leap-frog__dot:nth-child(2) {
    transform: translateX(calc(var(--uib-size) * 0.4));
    animation: leapFrog var(--uib-speed) ease calc(var(--uib-speed) / -1.5) infinite;
  }

  .leap-frog__dot:nth-child(3) {
    transform: translateX(calc(var(--uib-size) * 0.8)) rotate(0deg);
    animation: leapFrog var(--uib-speed) ease calc(var(--uib-speed) / -3) infinite;
  }

  @keyframes leapFrog {
    0% {
      transform: translateX(0) rotate(0deg);
    }

    33.333% {
      transform: translateX(0) rotate(180deg);
    }

    66.666% {
      transform: translateX(calc(var(--uib-size) * -0.4)) rotate(180deg);
    }

    99.999% {
      transform: translateX(calc(var(--uib-size) * -0.8)) rotate(180deg);
    }

    100% {
      transform: translateX(0) rotate(0deg);
    }
  }

  #hamburger-menu span:nth-child(1) {
    @apply absolute top-[25%] inset-0 w-full h-1 transition-all duration-300;
  }

  #hamburger-menu span:nth-child(2) {
    @apply absolute top-[50%] inset-0 w-full h-1 transition-all duration-300;
  }

  #hamburger-menu span:nth-child(3) {
    @apply absolute top-[75%] inset-0 w-full h-1 transition-all duration-300;
  }

  #hamburger-menu.active span:nth-child(1) {
    @apply -rotate-45 top-[50%];
  }

  #hamburger-menu.active span:nth-child(2) {
    @apply hidden;
  }

  #hamburger-menu.active span:nth-child(3) {
    @apply rotate-45 top-[50%];
  }

  #dropdown-menu-list li {
    @apply flex items-center justify-between w-full;
  }

  #dropdown-menu-list span {
    @apply text-lg font-bold text-white;
  }

  #logout-button {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 100%;
    height: 70px;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition-duration: .3s;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
    background-color: rgb(255, 65, 65);
  }

  /* plus sign */
  .sign {
    width: 100%;
    transition-duration: .3s;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .sign svg {
    width: 20px;
  }

  .sign svg path {
    fill: white;
  }
  /* text */
  .text {
    position: absolute;
    right: 0%;
    width: 0%;
    opacity: 0;
    color: white;
    font-size: 1.2em;
    font-weight: 600;
    transition-duration: .3s;
  }
  /* hover effect on button width */
  #logout-button:hover {
    transition-duration: .3s;
  }

  #logout-button:hover .sign {
    width: 30%;
    transition-duration: .3s;
    padding-left: 20px;
  }
  /* hover effect button's text */
  #logout-button:hover .text {
    opacity: 1;
    width: 70%;
    transition-duration: .3s;
    padding-right: 10px;
  }
  /* button click effect*/
  #logout-button:active {
    transform: translate(2px ,2px);
  }

  /* plus sign */
  .sign {
    width: 100%;
    transition-duration: .3s;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .sign svg {
    width: 17px;
  }

  .sign svg path {
    fill: white;
  }
  /* text */
  .text {
    position: absolute;
    right: 0%;
    width: 0%;
    opacity: 0;
    color: white;
    font-size: 1.2em;
    font-weight: 600;
    transition-duration: .3s;
  }

  #filters-container, #categories-container, #sort-and-order-container {
    @apply flex flex-col justify-between h-full gap-1 px-4 py-2 mt-4;
  }

  #filters-container > div {
    @apply w-full;
  }

  #filters-container label,
  #categories-container label,
  #sort-and-order-container label {
    @apply font-medium text-xl text-nowrap;
  }

  .filter-range-container {
    @apply flex items-center justify-between mt-2;
  }

  .filter-range-container input {
    @apply w-24 font-semibold text-xl p-2 px-6 rounded-full;
  } 

  #submit-preferences-form-button {
    @apply px-10 py-4 font-bold tracking-wide text-xl bg-green-600 transition-all hover:bg-green-700 rounded-xl;
  }
}
</style>