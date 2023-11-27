module.exports = {
  files: ["**/*.php"],
  proxy: "http://localhost:8000", // Asegúrate de incluir el protocolo y los dos puntos
  notify: false,
  snippetOptions: {
    ignorePaths: ["node_modules", "vendor"],
  },
};
