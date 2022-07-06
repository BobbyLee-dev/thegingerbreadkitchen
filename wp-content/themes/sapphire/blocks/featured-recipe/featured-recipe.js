import { useSelect } from '@wordpress/data';

wp.blocks.registerBlockType('sapphiretheme/featured-recipe', {
	title: 'Sapphire Featured Recipe',
	description: 'Add a new recipe',
	icon: 'dashicons-food',
	category: 'common',
	attributes: {
		recipeId: { type: 'string' },
	},
	edit: EditComponent,
	save: function () {
		return null;
	},
});

function EditComponent(props) {
	const allRecipes = useSelect((select) => {
		return select('core').getEntityRecords('postType', 'recipe', {
			per_page: -1,
		});
	});

	console.log(allRecipes);

	if (allRecipes == undefined) return <p>Loading...</p>;

	return (
		<div className="featured-professor-wrapper">
			<div className="professor-select-container">
				<select
					onChange={(e) =>
						props.setAttributes({ recipeId: e.target.value })
					}
				>
					<option value="">Select a Recipe</option>
					{allRecipes.map((recipe) => {
						return (
							<option
								value={recipe.id}
								selected={
									props.attributes.recipeId == recipe.id
								}
							>
								{recipe.title.rendered}
							</option>
						);
					})}
				</select>
			</div>
			<div>
				The HTML preview of the selected professor will appear here.
			</div>
		</div>
	);
}
