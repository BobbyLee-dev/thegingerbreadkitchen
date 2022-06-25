import { registerBlockType } from '@wordpress/blocks';
import Edit from './Edit';

registerBlockType('sapphiretheme/split-image-content', {
	title: 'Sapphire Split Image Content',
	attributes: {
		align: {
			type: 'string',
			default: 'full',
		},
		image: {
			type: 'string',
			default: '',
		},
		imageID: {
			type: 'number',
		},
		heading: {
			type: 'string',
			default: '',
		},
		content: {
			type: 'string',
			default: '',
		},
		buttonText: {
			type: 'string',
			default: '',
		},
		linkObject: {
			type: 'object',
			default: {
				url: '',
			},
		},
	},
	getEditWrapperProps() {
		return {
			'data-align': 'full',
		};
	},
	edit: Edit,
	save: SaveComponent,
});

function SaveComponent() {
	return null;
}
