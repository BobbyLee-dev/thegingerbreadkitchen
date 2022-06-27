import { link } from '@wordpress/icons';
import {
	ToolbarGroup,
	ToolbarButton,
	Popover,
	Button,
} from '@wordpress/components';
import {
	RichText,
	BlockControls,
	__experimentalLinkControl as LinkControl,
} from '@wordpress/block-editor';
import { useState } from '@wordpress/element';

function AdminButton({ buttonText, linkObject, setAttributes }) {
	const [isLinkPickerVisible, setIsLinkPickerVisible] = useState(false);

	function handleTextChange(x) {
		setAttributes({ buttonText: x });
	}

	function buttonHandler() {
		setIsLinkPickerVisible((prev) => !prev);
	}

	function handleLinkChange(newLink) {
		console.log(newLink);
		setAttributes({ linkObject: newLink });
	}

	return (
		<>
			<BlockControls>
				<ToolbarGroup>
					<ToolbarButton onClick={buttonHandler} icon={link} />
				</ToolbarGroup>
			</BlockControls>

			<RichText
				allowedFormats={[]}
				multiline={false}
				tagName="a"
				className="button"
				value={buttonText}
				onChange={handleTextChange}
				placeholder="Button"
			/>
			{isLinkPickerVisible && (
				<Popover
					position="middle center"
					onFocusOutside={() => setIsLinkPickerVisible(false)}
				>
					<LinkControl
						settings={[]}
						value={linkObject}
						onChange={handleLinkChange}
					/>
					<Button
						variant="primary"
						onClick={() => setIsLinkPickerVisible(false)}
						style={{ display: 'block', width: '100%' }}
					>
						Confirm Link
					</Button>
				</Popover>
			)}
		</>
	);
}

export default AdminButton;
