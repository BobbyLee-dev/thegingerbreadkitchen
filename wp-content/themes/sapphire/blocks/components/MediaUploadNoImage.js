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
				<div className="admin-button-wrap">
					<Button
						isPrimary
						onClick={openMedia}
						className="admin-button"
					>
						{__('Select an Image', 'sapphiretheme')}
					</Button>
				</div>
			</div>
		</MediaUploadCheck>
	);
};

export default MediaUploadNoImage;
