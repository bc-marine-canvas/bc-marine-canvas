// eslint-disable-next-line
import { Collapse } from "bootstrap/dist/js/bootstrap.esm.min.js";

import { Extensions } from "./extensions/extensions";
import { Form } from "./monday/form";
import { Copyright } from "./copyright/copyright";
import { Touchable } from "./touchable/touchable";

Extensions.apply();
Copyright.setYear();
Form.addSubmissionListener();
Touchable.addTouchedListener();
