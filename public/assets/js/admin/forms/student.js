crud.field("status")
    .onChange(function (field) {
        if (field.value == "active" || field.value == "potential") {
            crud.field("stop_date").hide();
            crud.field("stop_reason").hide();
            crud.field("expected_return_date").hide();
        } else {
            crud.field("stop_date").show();
            crud.field("stop_reason").show();
            crud.field("expected_return_date").show();
        }
    })
    .change();
