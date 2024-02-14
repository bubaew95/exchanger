import {RequestData} from "../../Server/RequestAdvertisementsInterface";
import {Image} from "../Image";
import {Button} from "react-bootstrap";
import {ListClickProps} from "./List";
import {Actions} from "../../react/controllers/ProposeExchange";

interface ListItemProps extends ListClickProps {
    item: RequestData;
}

export default function ({ item, onClick }: ListItemProps) {
    return (
        <li className="media mb-2 pb-1 border-bottom" key={item.id}>
            <Image src={`/${item.image}`} className="mr-3 border-1" alt={item.name}/>

            <div className="media-body">
                <h5 className="mt-0 mb-1 fw-400">{item.name}</h5>
                {
                    !item.isProposed
                        ? (
                            <Button variant="success" className='btn-sm mt-3' onClick={() => onClick(item.id, Actions.ADD)}>
                                <i className="fa fa-check-square mr-2" aria-hidden="true"></i>
                                Предложить
                            </Button>
                        )
                        : (
                            <Button variant="danger" className='btn-sm mt-3' onClick={() => onClick(item.id, Actions.DELETE)}>
                                <i className="fa fa-window-close mr-2" aria-hidden="true"></i>
                                Отменить предложение
                            </Button>
                        )
                }
            </div>
        </li>
    );
}