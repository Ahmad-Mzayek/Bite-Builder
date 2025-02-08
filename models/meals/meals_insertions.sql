ALTER TABLE dietary_filters AUTO_INCREMENT = 1;

CALL insert_meal(
    "Appetizers",
    "Hot Dog Burnt Ends",
    "hot_dogs_burnt_ends.png", 
    "Preheat the oven to 350 degrees F (175 degrees C). Line a baking sheet with aluminum foil.
    Combine hot dogs, mustard, brown sugar, cayenne pepper, onion powder, and black pepper in a large resealable bag. Shake bag so hot dogs are well coated with mustard and spice mixture. Spread out seasoned hot dogs onto the prepared baking sheet.
    Bake in the preheated oven for 1 hour.
    Remove hot dogs and cut them into thirds. Increase oven temperature to 400 degrees F (200 degrees C).
    Combine hot dog pieces and BBQ sauce in a bowl and mix until hot dogs are completely coated with sauce. Return to the baking sheet.
    Bake in the preheated oven for an additional 10 minutes.",
    16, 227, 85, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0);

CALL insert_meal(
    "Appetizers",
    "Caesar Roasted Broccoli",
    "caesar_roasted_broccoli.png", 
    "My family has a motto we frequently apply to our weeknight dinner routine: “When in doubt, roast some broccoli.” It’s the one vegetable side dish that all four of us are sure to eat—even my picky five year old. And it’s fairly easy to understand why: Roasted broccoli ticks all the boxes for a great vegetable side dish: It’s simple to prepare, delicious, and nutritious. But as my family’s resident home chef (and a former professional chef), what I like best about roasted broccoli is how easy it is to dress it up with a variety of ingredients and flavor profiles, avoiding the same boring side dish night after night.",
    4, 163, 25, 1, 0, 0, 0, 1, 0, 1, 1, 0, 0, 1);

CALL insert_meal(
    "Desserts",
    "Basque Cheesecake",
    "basque_cheesecake.png", 
    "This cake is a deeply caramelized cousin of American cheesecake, inspired by the famous “tarta de queso” by Santiago Riviera of La Viña in Donostia-San Sebastián, Spain. Its defining features are a burnt top and barely set center, the result of baking the eggy cream cheese batter at a very high temperature. To achieve the perfect balance between the deeply browned top and creamy center, we chill the batter after mixing, and sprinkle the top with sugar right before the cake goes into a 400-degree oven.",
    12, 320, 400, 1, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0);

CALL insert_meal(
    "Main Courses",
    "Nigerian Beef Suya",
    "nigerian_beef_suya.png", 
    "Suya is Nigerian street food at its finest—think nutty, spicy beef threaded onto skewers then grilled, the finished sticks cradled in paper or foil with a side of fresh tomatoes, sliced red onions, and a sprinkling of yajin kuli. Yajin kuli is made from yaji—a blend of chiles, ginger, garlic, onions, salt and other spices—and ground kuli kuli, which is essentially dehydrated and defatted groundnut (peanut) paste. Suya originated in the north of Nigeria, where the knowledge and mastery of meat is second to none.",
    3, 145, 95, 1, 0, 0, 0, 1, 1, 1, 0, 0, 1, 1);

CALL insert_meal(
    "Main Courses",
    "Italian-American Beef Braciole",
    "italian-american_beef_braciole.png", 
    "At its core, braciole is a kind of involtini—a stuffed and rolled piece of meat. The details that define braciole can vary by region in Italy, and even by household. The meat type (pork or beef), the rolling size (one larger roll to share or smaller individual bundles), cooking method (braised, pan-fried, or grilled) and seasoning elements (breadcrumbs, chunks of cheese, or fresh herbs) are examples of the different directions this seemingly simple meat bundle recipe can take.",
    4, 600, 200, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0);

CALL insert_meal(
    "Main Courses",
    "Soufflé Omelette With Cheese",
    "souffle_omelette_with_cheese.png", 
    "The soufflé omelette is the easiest way to practice making any kind of soufflé, given the low barrier to entry. If you have some eggs and a few extra minutes to beat the whites, you can do it. No need to prep a soufflé dish or preheat an oven, and no need to make a béchamel or pastry cream base, nor bake it until puffed and browned.",
    1, 550, 20, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0);

CALL insert_meal(
    "Main Courses",
    "Chicken Bacon Ranch Sliders",
    "chicken_bacon_ranch_sliders.png",
    "Gather all ingredients. Preheat the oven to 350 degrees F (180 degrees C).
    Place bacon in a large skillet and cook over medium-high heat, turning occasionally, until evenly browned, about 10 minutes. Drain bacon slices on paper towels. Crumble when cool enough to handle.
    Using a sharp serrated knife, carefully cut slider rolls in half horizontally. Set tops of rolls aside. Place bottom halves of rolls onto a rimmed baking tray.
    Add chicken and prepared ranch dressing to a bowl; stir to thoroughly coat chicken.
    Spread chicken onto slider rolls. Top chicken mixture with cheese and crumbled bacon. Place top halves of rolls on top of filling.
    Melt butter in the microwave in a microwave-safe bowl on High, about 30 seconds. Stir ranch seasoning into butter.
    Using a pastry brush, brush tops of sliders with ranch butter. Cover rolls with foil.
    Bake in the preheated oven for 20 minutes. Remove foil and bake until filling is hot, buns are golden, and cheese is melted, about 10 more minutes. Serve immediately.",
    12, 400, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0);

CALL insert_meal(
    "Sauces & Condiments",
    "Blood Orange Vinaigrette",
    "blood_orange_vinaigrette.png",
    "Combine olive oil, blood orange juice, red wine vinegar, honey, mustard, salt, and pepper in a blender. Process until well combined and smooth.",
    8, 150, 10, 1, 1, 0, 1, 0, 1, 1, 1, 1, 0, 0);