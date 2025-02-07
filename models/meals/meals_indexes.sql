CREATE INDEX index_meal_name
ON meals(meal_name);

CREATE INDEX index_nb_portions
ON meals(nb_portions);

CREATE INDEX index_nb_calories_per_portion
ON meals(nb_calories_per_portion);

CREATE INDEX index_preparation_duration_minutes
ON meals(preparation_duration_minutes);

CREATE INDEX index_category_name
ON meals(category_name);