
export const Button = ({title, children, ...props} : any) => {
    return (
        <button {...props}>
            {children}
        </button>
    );
}