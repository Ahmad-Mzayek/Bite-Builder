module.exports = {
  content: ["./src/**/*.{html,js, php}"],
  theme: {
    extend: {
      colors: {
        primary: "rgba(var(--primary))",
        "overlay-rgba": "rgba(0,0,0,0.5)",
      },
    },
  },
  plugins: [],
};
