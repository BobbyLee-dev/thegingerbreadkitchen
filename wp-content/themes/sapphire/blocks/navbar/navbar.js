wp.blocks.registerBlockType("sapphiretheme/navbar", {
  title: "Sapphire Navbar",
  edit: function () {
    return wp.element.createElement("div", { className: "placeholder-block" }, "Navbar Placeholder")
  },
  save: function () {
    return null
  }
})
