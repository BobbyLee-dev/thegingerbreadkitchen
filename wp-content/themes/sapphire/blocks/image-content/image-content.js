import { InnerBlocks } from '@wordpress/block-editor'
import { registerBlockType } from '@wordpress/blocks'

registerBlockType("sapphiretheme/image-content", {
  title: "Sapphire Image Content",
  edit: Edit,
  save: SaveComponent
})

function Edit() {
  return (
    <div className="page-banner">
      <div className="page-banner__bg-image" style={{ backgroundImage: "url('/wp-content/themes/sapphire/images/library-hero.jpg')" }}></div>
      <div className="page-banner__content container t-center c-white">
        <InnerBlocks allowedBlocks={['sapphiretheme/sapphire-heading']} />
      </div>
    </div>
  )
}

function SaveComponent() {
	return null
}