import { registerBlockType } from '@wordpress/blocks';
import Edit from './Edit';

registerBlockType('sapphiretheme/split-image-content', {
	title: 'Sapphire Split Image Content',
	attributes: {
		image: {
			type: 'string',
			default: '',
		},
		imageID: {
			type: 'number',
		},
	},
	edit: Edit,
	save: SaveComponent,
});

function SaveComponent() {
	return null;
}
