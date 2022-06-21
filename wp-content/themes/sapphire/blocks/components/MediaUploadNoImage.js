/**
 * WordPress dependencies
 */
import { MediaUploadCheck } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Media upload with no image
 */
const MediaUploadNoImage = ({ openMedia }) => {
	return (
		<MediaUploadCheck>
			<div className="image-wrap">
				<Button isPrimary onClick={openMedia}>
					{__('Select an Image', 'sapphiretheme')}
				</Button>
			</div>
		</MediaUploadCheck>
	);
};

export default MediaUploadNoImage;
