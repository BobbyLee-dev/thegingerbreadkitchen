/**
 * WordPress dependencies
 */
import { MediaUploadCheck } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Vendor dependencies
 */
import PropTypes from 'prop-types';

/**
 * Media upload with image
 */
const MediaUploadWithImage = ({ formLogo, openMedia, setAttributes }) => {
	return (
		<MediaUploadCheck>
			<div className="admin-img-wrap">
				<img
					src={formLogo}
					onClick={openMedia}
					style={{ cursor: 'pointer' }}
				/>
			</div>
			<Button isPrimary onClick={openMedia}>
				{__('Change Image', 'donation-form')}
			</Button>
			<Button isLink onClick={() => setAttributes({ formLogo: '' })}>
				{__('Remove Image', 'donation-form')}
			</Button>
		</MediaUploadCheck>
	);
};

MediaUploadWithImage.PropTypes = {
	formLogo: PropTypes.string,
	openMedia: PropTypes.func,
	setAttributes: PropTypes.func,
};

export default MediaUploadWithImage;
