/**
 * WordPress dependencies
 */
import { MediaUploadCheck } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Media upload with image
 */
const MediaUploadWithImage = ({ image, openMedia, setAttributes }) => {
	return (
		<MediaUploadCheck>
			<div className="admin-img-wrap">
				<img
					src={image}
					onClick={openMedia}
					style={{ cursor: 'pointer' }}
				/>
			</div>
			<div class="admin-button-wrap">
				<Button isPrimary onClick={openMedia} className="admin-button">
					{__('Change Image', 'sapphiretheme')}
				</Button>
				<Button
					isDestructive
					isPrimary
					onClick={() => setAttributes({ formLogo: '' })}
					className="admin-button remove-button"
				>
					{__('Remove Image', 'sapphiretheme')}
				</Button>
			</div>
		</MediaUploadCheck>
	);
};

export default MediaUploadWithImage;
