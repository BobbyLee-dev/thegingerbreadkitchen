wp.blocks.registerBlockType("sapphiretheme/header", {
  title: "Sapphire Header",
  edit: function () {
    return wp.element.createElement("div", { className: "placeholder-block" }, "Header Placeholder")
  },
  save: function () {
    return null
  }
})
