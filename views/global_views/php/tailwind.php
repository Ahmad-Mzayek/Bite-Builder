<style type="text/tailwindcss">
  @layer base {
  .content-auto {
    content-visibility: auto;
  }

  body {
    background-color: var(--primary);
    @apply overflow-x-hidden;
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
    @apply absolute top-[25%] inset-0 w-full h-1 bg-white transition-all duration-300;
  }

  #hamburger-menu span:nth-child(2) {
    @apply absolute top-[50%] inset-0 w-full h-1 bg-white transition-all duration-300;
  }

  #hamburger-menu span:nth-child(3) {
    @apply absolute top-[75%] inset-0 w-full h-1 bg-white transition-all duration-300;
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

  /* From Uiverse.io by vinodjangid07 */ 
  #logout-button {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 70px;
    height: 70px;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition-duration: .3s;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
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
    width: 100%;
    border-radius: 40px;
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
    @apply min-h-[28rem] flex flex-col items-center justify-between;
  }

  #filters-container label,
  #categories-container label,
  #sort-and-order-container label {
    @apply font-semibold text-white text-2xl
  }

  #filters-container > div,
  #categories-container > div {
    @apply flex w-1/2 items-center text-nowrap gap-4;
  }

  #sort-and-order-container > div {
    @apply flex w-3/4 items-center text-nowrap gap-4;
  }

  .filter-range-container {
    @apply flex items-center self-start w-1/4;
  }

  .filter-range-container input {
    @apply w-20 font-semibold text-xl p-2;
  }

  #submit-meal-filters-form-button {
    @apply px-10 py-8 font-bold tracking-wide text-xl bg-green-600 transition-all hover:bg-green-700 rounded-xl;
  }

    /* From Uiverse.io by Na3ar-17 */ 
  /* .radio-input {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .radio-input * {
    box-sizing: border-box;
    padding: 0;
    margin: 0;
  }

  .radio-input label {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 0px 20px;
    width: 220px;
    cursor: pointer;
    height: 50px;
    position: relative;
  }

  .radio-input label::before {
    position: absolute;
    content: "";
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 220px;
    height: 45px;
    z-index: -1;
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    border-radius: 10px;
    border: 2px solid transparent;
  }
  .radio-input label:hover::before {
    transition: all 0.2s ease;
    background-color: #2a2e3c;
  }

  .radio-input .label:has(input:checked)::before {
    background-color: #2d3750;
    border-color: #435dd8;
    height: 50px;
  }
  .radio-input .label .text {
    color: #fff;
  }

  .radio-input .label input[type="radio"] {
    background-color: #202030;
    appearance: none;
    width: 17px;
    height: 17px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .radio-input .label input[type="radio"]:checked {
    background-color: #435dd8;
    -webkit-animation: puls 0.7s forwards;
    animation: pulse 0.7s forwards;
  }

  .radio-input .label input[type="radio"]:before {
    content: "";
    width: 6px;
    height: 6px;
    border-radius: 50%;
    transition: all 0.1s cubic-bezier(0.165, 0.84, 0.44, 1);
    background-color: #fff;
    transform: scale(0);
  }

  .radio-input .label input[type="radio"]:checked::before {
    transform: scale(1);
  }

  @keyframes pulse {
    0% {
      box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
    }
    70% {
      box-shadow: 0 0 0 8px rgba(255, 255, 255, 0);
    }
    100% {
      box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
    }
  } */
}
</style>