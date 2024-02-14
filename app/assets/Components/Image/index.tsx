import BootstrapImage from 'react-bootstrap/Image';
import classNames from "classnames";
import "./Image.css";

export const Image = ({src, className = '', ...props}: any) => {

    if(null === src || '/null' === src) {
        src = '/img/noimage.png';
    }

    return (
        <BootstrapImage
            src={src}
            className={classNames('image-crop', className)}
            {...props}
        />
    )
};