wp.blocks.registerBlockType("sapphiretheme/footer", {
  title: "Sapphire Footer",
  edit: function () {
    return wp.element.createElement("div", { className: "placeholder-block" }, "Footer Placeholder")
  },
  save: function () {
    return null
  }
})
