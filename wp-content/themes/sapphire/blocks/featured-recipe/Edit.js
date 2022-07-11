import { useBlockProps, RichText } from '@wordpress/block-editor';
import AdminButton from '../components/AdminButton';
import AdminImage from '../components/AdminImage';

const Edit = ({ attributes, setAttributes }) => {
	const blockProps = useBlockProps({
		className: 'split-image-content',
	});

	return <section {...blockProps}></section>;
};

export default Edit;
