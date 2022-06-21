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
			<Button isPrimary onClick={openMedia}>
				{__('Change Image', 'sapphiretheme')}
			</Button>
			<Button isLink onClick={() => setAttributes({ formLogo: '' })}>
				{__('Remove Image', 'sapphiretheme')}
			</Button>
		</MediaUploadCheck>
	);
};

export default MediaUploadWithImage;
